<?php

use App\Http\Controllers\Admin\Config\AiToolsController;
use App\Http\Controllers\Admin\Config\BrandingController;
use App\Http\Controllers\Admin\Config\FinanceController;
use App\Http\Controllers\Admin\Config\GdprController;
use App\Http\Controllers\Admin\Config\GeneralController;
use App\Http\Controllers\Admin\Config\LoginController;
use App\Http\Controllers\Admin\Config\MoreController;
use App\Http\Controllers\Admin\Config\SeoController;
use App\Http\Controllers\Admin\Config\SmtpController;
use App\Http\Controllers\Admin\Config\StorageController;
use App\Http\Controllers\Admin\Finance\PlanController;
use App\Http\Controllers\Admin\Finance\TokenPackPlanController;
use App\Http\Controllers\AdsController;
use App\Http\Controllers\AdvertisController;
use App\Http\Controllers\AIArticleWizardController;
use App\Http\Controllers\AiChatbotModelController;
use App\Http\Controllers\AIChatController;
use App\Http\Controllers\AIController;
use App\Http\Controllers\AIFineTuneController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AssistantController;
use App\Http\Controllers\Auth\Google2FAController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Chatbot\ChatbotController;
use App\Http\Controllers\Chatbot\ChatbotTrainingController;
use App\Http\Controllers\ChatPdfController;
use App\Http\Controllers\Common\CommonController;
use App\Http\Controllers\Common\HealthController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\BrandController;
use App\Http\Controllers\Dashboard\NotificationController;
use App\Http\Controllers\Dashboard\SearchController;
use App\Http\Controllers\Dashboard\SettingsController;
use App\Http\Controllers\Dashboard\SupportController;
use App\Http\Controllers\Dashboard\TranslateController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\EmailTemplatesController;
use App\Http\Controllers\ExportChatController;
use App\Http\Controllers\Finance\ApiCostController;
use App\Http\Controllers\Finance\CreditsTransferController;
use App\Http\Controllers\Finance\GatewayController;
use App\Http\Controllers\Finance\MobilePaymentsController;
use App\Http\Controllers\Finance\PaymentProcessController;
use App\Http\Controllers\InstallationController;
use App\Http\Controllers\Integration\IntegrationController;
use App\Http\Controllers\Market\MarketPlaceController;
use App\Http\Controllers\OpenAi\GeneratorController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Payment\PlanAndPricingController;
use App\Http\Controllers\PremiumSupportController;
use App\Http\Controllers\PrivatePlanController;
use App\Http\Controllers\PromptController;
use App\Http\Controllers\Settings\SearchapiSettingController;
use App\Http\Controllers\Team\TeamController;
use App\Http\Controllers\Themes\ThemeController;
use App\Http\Controllers\TTSController;
use App\Http\Controllers\Voice\ElevenlabVoiceController;
use App\Http\Middleware\CheckTemplateTypeAndPlan;
use App\Services\DeFi\DeFi;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Business\ClientController;
use App\Http\Controllers\Business\ProjectController;
use App\Http\Controllers\Business\InvoiceController;
use App\Http\Controllers\Business\BookingController;
use App\Http\Controllers\Business\AnalyticsController;
use App\Http\Controllers\Business\AiEstimatorController;
use App\Http\Controllers\Business\BusinessJobType;
use App\Http\Controllers\Business\BusinessBookingCalendlyWebhookController;
use App\Http\Controllers\Business\SmsTwilioController;

Route::group([
    'prefix'     => LaravelLocalization::setLocale(),
    'middleware' => [
        'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'newExtensionInstalled',
    ],
], static function () {

    Livewire::setUpdateRoute(static function ($handle) {
        return Route::post('/livewire/update', $handle);
    });

    Route::prefix('dashboard')
        ->middleware(['auth', 'updateUserActivity'])
        ->name('dashboard.')
        ->group(static function () {

            Route::middleware('checkInstallation')
                ->get('/', [UserController::class, 'redirect'])
                ->name('index');

            DeFi::routes();

            // User Area
            Route::prefix('user')
                ->name('user.')
                ->group(function () {
                    Route::get('', [UserController::class, 'index'])->name('index');

                    Route::get('check/payment', [PaymentProcessController::class, 'checkSubscriptionStatusFromAjax'])->name('check.payment');

                    Route::post('/mark-tour-seen', [UserController::class, 'markTourSeen'])->name('markTourSeen');
                    Route::group([
                        'controller' => Google2FAController::class,
                        'prefix'     => '2fa',
                        'as'         => '2fa.',
                    ], static function () {
                        Route::get('activate', 'activate2FA')->name('activate');
                        Route::post('activate', 'assign2FA');
                        Route::get('deactivate', 'deactivate2FA')->name('deactivate');
                    });

                    // dash_notify_seen
                    Route::post('/dash_notify_seen', [UserController::class, 'markDashNotifySeen'])->name('dash_notify_seen');

                    // premium support
                    Route::get('premium-support', PremiumSupportController::class)->name('premium-support');

                    Route::prefix('api-keys')->name('apikeys.')->group(function () {
                        Route::get('/', [UserController::class, 'apiKeysList'])->name('index');
                        Route::post('/update', [UserController::class, 'apiKeysSave'])->name('update');
                    });

                    Route::group([
                        'as'         => 'integration.',
                        'prefix'     => 'integration',
                        'controller' => IntegrationController::class,
                    ], static function () {
                        Route::get('share/{userIntegration}/workbook/{userOpenai}', 'workbook')->name('share.workbook');
                        Route::post('share/{userIntegration}/workbook/{userOpenai}', 'storeWorkbook');
                        Route::post('share/{userIntegration}/image/{userOpenai}', 'storeImage')->name('share.image');
                    });

                    Route::resource('integration', IntegrationController::class)->only(['index', 'edit', 'update']);

                    // brand voice
                    Route::get('brand', [BrandController::class, 'index'])->name('brand.index')->middleware(CheckTemplateTypeAndPlan::class);
                    Route::resource('brand', BrandController::class)->except(['index', 'show', 'destroy']);
                    Route::group([
                        'as'         => 'brand.',
                        'prefix'     => 'brand',
                        'controller' => BrandController::class,
                    ], static function () {
                        Route::get('delete/{brand}', 'delete')->name('delete');
                        Route::get('get-products/{brand?}', 'getProducts')->name('brand.getProducts');
                    });

                    // teams
                    Route::group([
                        'as'         => 'team.',
                        'prefix'     => 'team',
                        'controller' => TeamController::class,
                    ], static function () {
                        Route::get('', 'index')->name('index');
                        Route::get('{team}/invitations', 'invitations')->name('invitations');
                        Route::post('{team}/invitation', 'storeInvitation')->name('invitation.store');
                        Route::get('{team}/member/{teamMember}/edit', 'teamMember')->name('member.edit');
                        Route::post('{team}/member/{teamMember}/update', 'teamMemberUpdate')->name('member.update');
                        Route::get('{team}/member/{teamMember}/delete', 'teamMemberDelete')->name('member.delete');
                    });

                    // user generator
                    Route::group([
                        'as'         => 'generator.',
                        'prefix'     => 'generator',
                        'controller' => GeneratorController::class,
                    ], static function () {
                        Route::get('{workbook_slug?}', [GeneratorController::class, 'index'])->name('index')->middleware(CheckTemplateTypeAndPlan::class);
                        Route::get('/option/{slug}', [GeneratorController::class, 'generatorOptions'])->name('options')->middleware(CheckTemplateTypeAndPlan::class);

                        Route::post('/generate-stream', [GeneratorController::class, 'buildStreamedOutput'])->name('stream.generate')->middleware('surveyMiddleware');
                        Route::post('/reduce-tokens/{type}', [GeneratorController::class, 'reduceTokensWhenIntterruptStream'])->name('reduce-tokens');
                    });

                    Route::get('private/subscription/{key}', [PrivatePlanController::class, 'index']);

                    // Openai generator
                    Route::prefix('openai')->name('openai.')
                        ->group(function () {
                            Route::get('/', [UserController::class, 'openAIList'])->name('list')->middleware(CheckTemplateTypeAndPlan::class);
                            Route::get('/favorite-openai', [UserController::class, 'openAIFavoritesList'])->name('list.favorites');
                            Route::post('/dashboard/user/openai/favorite', [UserController::class, 'openAIFavorite'])->name('dashboard.user.openai.favorite');

                           
                            Route::post('/favorite', [UserController::class, 'openAIFavorite']);

                            Route::get('generator/realtime', [GeneratorController::class, 'realtime'])->name('realtime.chat');
                            Route::get('generator/check/status', [UserController::class, 'checkStatus'])->name('check.status');

                            // Generators
                            Route::middleware([
                                CheckTemplateTypeAndPlan::class,
                            ])
                                ->group(function () {
                                    Route::get('/generator/{slug}', [UserController::class, 'openAIGenerator'])->name('generator');
                                    Route::get('/generator/{slug}/workbook', [UserController::class, 'openAIGeneratorWorkbook'])->name('generator.workbook');
                                });

                            Route::prefix('custom')->name('custom.')->group(function () {
                                Route::get('/', [UserController::class, 'openAICustomList'])->name('list');
                                Route::get('/add-or-update/{id?}', [UserController::class, 'openAICustomAddOrUpdate'])->name('addOrUpdate');
                                Route::get('/delete/{id?}', [UserController::class, 'openAICustomDelete'])->name('delete');
                                Route::post('/save', [UserController::class, 'openAICustomAddOrUpdateSave']);
                            });

                            // Generators Generate
                            Route::post('/generate', [AIController::class, 'buildOutput'])->name('output');

                            Route::get('/generate', [AIController::class, 'streamedTextOutput']);

                            Route::post('/getYoutubeCaptions', [AIController::class, 'getYoutubeCaptions']);

                            Route::post('/check/videoprogress', [AIController::class, 'checkVideoProgress']);

                            Route::get('/rewrite', [AIController::class, 'reWrite'])->name('rewriter')->middleware(CheckTemplateTypeAndPlan::class);

                            Route::get('/generate/lazyload', [AIController::class, 'lazyLoadImage'])->name('lazyloadimage');

                            Route::post('/image/generate', [AIController::class, 'chatImageOutput'])->name('chat.image');

                            // Fine Tune
                            Route::post('/add-fine-tune', [AIFineTuneController::class, 'addFineTune']);
                            Route::post('/delete-fine-tune', [AIFineTuneController::class, 'deleteFineTune']);

                            // Low systems
                            Route::post('/low/generate_save', [AIController::class, 'lowGenerateSave']);
                            Route::post('message/title_save', [AIController::class, 'messageTitleSave']);

                            Route::post('/generate-speech', [TTSController::class, 'generateSpeech']);

                            Route::post('/update-writing', [AIController::class, 'updateWriting']);

                            // Documents
                            Route::prefix('documents')->name('documents.')->group(function () {
                                Route::get('/all/{id?}', [UserController::class, 'documentsAll'])->name('all');
                                Route::get('/images', [UserController::class, 'documentsImages'])->name('images');
                                Route::get('/single/{slug}', [UserController::class, 'documentsSingle'])->name('single');
                                Route::get('/delete/{slug}', [UserController::class, 'documentsDelete'])->name('delete');
                                Route::get('/delete/image/{slug}', [UserController::class, 'documentsImageDelete'])->name('image.delete');
                                Route::post('/workbook-save', [UserController::class, 'openAIGeneratorWorkbookSave']);

                                Route::post('/update-folder/{folder}', [UserController::class, 'updateFolder'])->name('update-folder');
                                Route::post('/update-file/{file}', [UserController::class, 'updateFile'])->name('update-file');

                                Route::post('/delete-folder/{folder}', [UserController::class, 'deleteFolder'])->name('delete-folder');
                                Route::post('/new-folder', [UserController::class, 'newFolder'])->name('new-folder');
                                Route::post('/move-to-folder', [UserController::class, 'moveToFolder'])->name('move-to-folder');

                                // make favorite
                                Route::post('/favorite', [UserController::class, 'docsFavorite'])->name('favorite');
                                Route::post('/overview', [UserController::class, 'overview'])->name('overview');
                            });

                            Route::prefix('chat')->name('chat.')->group(function () {
                                Route::get('/ai-chat-list', [AIChatController::class, 'openAIChatList'])->name('list')->middleware(CheckTemplateTypeAndPlan::class);
                                Route::get('/ai-chat/{slug?}', [AIChatController::class, 'openAIChat'])->name('chat')->middleware(CheckTemplateTypeAndPlan::class);
                                Route::match(['get', 'post'], '/chat-send', [AIChatController::class, 'chatOutput']);
                                Route::match(['get', 'post'], '/chatbot-send', [AIChatController::class, 'chatbotOutput']);
                                Route::post('/open-chat-area-container', [AIChatController::class, 'openChatAreaContainer']);
                                Route::post('/open-chatbot-area', [AIChatController::class, 'openChatBotArea'])->name('open-chatbot-area');
                                Route::post('/start-new-chat', [AIChatController::class, 'startNewChat']);
                                Route::post('/start-new-doc-chat', [AIChatController::class, 'startNewDocChat']);
                                Route::post('/start-new-chatbot', [AIChatController::class, 'startNewChatBot']);
                                Route::post('/search', [AIChatController::class, 'search']);
                                Route::post('/delete-chat', [AIChatController::class, 'deleteChat']);
                                Route::post('/clear-chats', [AIChatController::class, 'clearChats']);
                                Route::post('/rename-chat', [AIChatController::class, 'renameChat']);

                                Route::post('/transaudio', [AIChatController::class, 'transAudio']);

                                Route::post('/prompts', [PromptController::class, 'getAll']);
                                Route::post('/add-prompt', [PromptController::class, 'addNew']);
                                Route::post('/update-prompt', [PromptController::class, 'updateFav']);
                                Route::post('/delete-prompt', [PromptController::class, 'deletePrompt']);

                                // routes/web.php
                                Route::get('/generate-pdf', [ExportChatController::class, 'generatePdf']);
                                Route::get('/generate-word', [ExportChatController::class, 'generateWord']);
                                Route::get('/generate-txt', [ExportChatController::class, 'generateTxt']);

                                // Low systems
                                Route::post('/low/chat_save', [AIChatController::class, 'lowChatSave']);
                            });

                            Route::prefix('articlewizard')->name('articlewizard.')->group(function () {
                                Route::get('/new', [AIArticleWizardController::class, 'newArticle'])->name('new')->middleware(CheckTemplateTypeAndPlan::class);
                                Route::get('/genarticle', [AIArticleWizardController::class, 'generateArticle'])->name('genarticle');
                                Route::post('/update', [AIArticleWizardController::class, 'updateArticle'])->name('update');
                                Route::post('/clear', [AIArticleWizardController::class, 'clearArticle'])->name('clear');
                                Route::post('/genkeywords', [AIArticleWizardController::class, 'generateKeywords'])->name('genkeywords');
                                Route::post('/gentitles', [AIArticleWizardController::class, 'generateTitles'])->name('gentitles');
                                Route::post('/genoutlines', [AIArticleWizardController::class, 'generateOutlines'])->name('genoutlines');
                                Route::post('/genimages', [AIArticleWizardController::class, 'generateImages'])->name('genimages');
                                Route::post('/remains', [AIArticleWizardController::class, 'userRemaining'])->name('remains');

                                Route::get('/', [AIArticleWizardController::class, 'index'])->name('index');
                                Route::get('/{article}', [AIArticleWizardController::class, 'show'])->name('show');
                                Route::get('/{article}/edit', [AIArticleWizardController::class, 'editArticle'])->name('edit');

                                Route::post('/startover', [AIArticleWizardController::class, 'startover'])->name('startover');
                            });

                                                            Route::prefix('vision')->name('vision.')->group(function () {
                                Route::get('/ai-vision', [AIChatController::class, 'openAIChat'])->name('vision');
                            });

                        });

                    // user profile settings

                    Route::prefix('settings')->name('settings.')->group(function () {
                        Route::get('/', [UserController::class, 'userSettings'])->name('index');
                        Route::post('/save', [UserController::class, 'userSettingsSave']);
                        Route::get('/delete-account', [UserController::class, 'deleteAccount'])->name('deleteAccount');
                        Route::post('/delete-account', [UserController::class, 'deleteAccountRequest'])->name('deleteAccount.send');

                        Route::get('openai/test', [SettingsController::class, 'openaiTest'])->name('openai.test');
                        Route::get('anthropic/test', [SettingsController::class, 'anthropicTest'])->name('anthropic.test');
                        Route::get('gemini/test', [SettingsController::class, 'geminiTest'])->name('gemini.test');
                    });
                    // Subscription and payment
                    Route::prefix('payment')
                        ->name('payment.')
                        ->group(function () {
                            Route::get('', PlanAndPricingController::class)->name('subscription');
                            Route::get('/prepaid/{planId}/{gatewayCode}', [PaymentProcessController::class, 'startPrepaidPaymentProcess'])->name('startPrepaidPaymentProcess');
                            Route::get('/subscribe/{planId}/{gatewayCode}', [PaymentProcessController::class, 'startSubscriptionProcess'])->name('startSubscriptionProcess');
                            Route::match(['get', 'post'], '/start/subscription/checkout/{gateway?}/{referral?}', [PaymentProcessController::class, 'startSubscriptionCheckoutProcess'])->name('subscription.checkout');
                            Route::match(['get', 'post'], '/start/prepaid/checkout/{gateway?}/{referral?}', [PaymentProcessController::class, 'startPrepaidCheckoutProcess'])->name('prepaid.checkout');
                            Route::get('/subscribe-cancel', [PaymentProcessController::class, 'cancelActiveSubscription'])->name('cancelActiveSubscription');
                            Route::post('/paypal/create-paypal-order', [PaymentProcessController::class, 'createPayPalOrder'])->name('prepaid.createPayPalOrder');
                            Route::post('iyzico/prepaid/callback', [PaymentProcessController::class, 'iyzicoPrepaidCallback'])->name('iyzico.prepaid.callback');
                            Route::post('iyzico/subscribe/callback', [PaymentProcessController::class, 'iyzicoSubscribeCallback'])->name('iyzico.subscribe.callback');
                            Route::get('iyzico/products', [PaymentProcessController::class, 'iyzicoProductsList'])->name('iyzico.products');

                            Route::get('succesful', [PaymentProcessController::class, 'successful'])->name('succesful');
                            Route::post('/user-subscribe-cancel/{id}', [PaymentProcessController::class, 'cancelActiveSubscriptionByAdmin'])->name('cancelActiveSubscriptionByAdmin');
                            Route::post('/assign-plan', [PaymentProcessController::class, 'assignPlanByAdmin'])->name('assignPlanByAdmin');
                            Route::post('/assign-token-plan', [PaymentProcessController::class, 'assignTokenByAdmin'])->name('assignTokenByAdmin');

                            Route::post('update-address', [UserController::class, 'userSettingsUpdate'])->name('updateAddressDetails');
                        });

                    // Orders invoice billing
                    Route::prefix('orders')->name('orders.')->group(function () {
                        Route::get('/', [UserController::class, 'invoiceList'])->name('index');
                        Route::get('/order/{order_id}', [UserController::class, 'invoiceSingle'])->name('invoice');
                    });
                    // Affiliates
                    Route::prefix('affiliates')->name('affiliates.')->group(function () {
                        Route::get('/', [UserController::class, 'affiliatesList'])->name('index');
                        Route::post('/send-invitation', [UserController::class, 'affiliatesListSendInvitation']);
                        Route::post('/send-request', [UserController::class, 'affiliatesListSendRequest']);
                        Route::get('/users', [UserController::class, 'affiliatesUsers'])->name('users');
                    });

                    Route::resource('voice', ElevenlabVoiceController::class)->except('show', 'destroy');
                    Route::get('voice/{voice}', [ElevenlabVoiceController::class, 'delete'])->name('voice.destroy');

                });
            // Admin Area
            Route::prefix('business')
            ->name('business.')
            ->group(function () {
                
                // Group all client routes together with the same controller
                Route::group([
                    'controller' => \App\Http\Controllers\Business\ClientController::class, // Full namespace
                    'prefix' => 'clients',
                    'as' => 'clients.',
                ], function () {
                    Route::get('/', 'index')->name('index');
                    Route::post('/datatable', 'datatable')->name('datatable');
                    Route::get('/create', 'create')->name('create');
                    Route::post('/', 'store')->name('store');
                    Route::get('/{client}', 'show')->name('show');
                    Route::get('/{client}/edit', 'edit')->name('edit');
                    Route::put('/{client}', 'update')->name('update');
                    Route::delete('/bulk-delete', 'bulkAction')->name('bulkAction');
                  
                    Route::delete('/{client}', 'destroy')->name('destroy'); // Delete client
                });
               
                Route::group([
                    'controller' => \App\Http\Controllers\Business\CalenderController::class, // Full namespace
                    'prefix' => 'calender',
                    'as' => 'calender.',
                ], function () {
                    Route::get('/', 'index')->name('index');
                     Route::get('/redirect', 'redirectToGoogle')->name('redirect');
                    Route::get('/callback', 'handleGoogleCallback')->name('callback');
                });
                Route::group([
                    'controller' => \App\Http\Controllers\Business\BusinessTaxController::class, // Full namespace
                    'prefix'     => 'taxes',
                    'as'         => 'taxes.',
                ], function () {
                    Route::get('/', 'index')->name('index');
                    Route::post('/gettaxesdata', 'gettaxesdata')->name('gettaxesdata');
                    Route::get('/create', 'create')->name('create');
                    Route::post('/', 'store')->name('store');
                    Route::get('/{taxes}', 'show')->name('show');
                    Route::get('/{tax}/edit', 'edit')->name('edit');
                     Route::put('/{tax}', 'update')->name('update');
                      Route::delete('/bulk-delete', 'bulkAction')->name('bulkAction');
                    Route::get('/destroy/{id}', 'destroyByGet')->name('destroy.get');
                });
                Route::group([
                    'controller' => \App\Http\Controllers\Business\ProjectController::class, // Full namespace
                    'prefix'     => 'projects',
                    'as'         => 'projects.',
                ], function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/create', 'create')->name('create');
                    Route::post('/', 'store')->name('store');
                    Route::get('/{project}', 'show')->name('show');
                    Route::get('/{project}/edit', 'edit')->name('edit');
                    Route::put('/{project}', 'update')->name('update');
                      Route::delete('/bulk-delete', 'bulkdelete')->name('bulkAction');
                    Route::delete('/{project}', 'destroy')->name('destroy'); // Delete project
                    Route::post('/getProjectdata', 'getProjectdata')->name('getProjectdata');
                });
               Route::group([
                    'controller' => \App\Http\Controllers\Business\AiEstimatorController::class,
                    'prefix' => 'ai-estimator',
                    'as' => 'ai-estimator.',
                ], function () {
                    Route::get('/', 'index')->name('index');
                    Route::post('/task-estimate', 'estimate')->name('task.estimate');
                });

                Route::group([
                    'controller' => \App\Http\Controllers\Business\InvoiceController::class,
                    'prefix'     => 'invoices',
                    'as'         => 'invoices.',
                ], function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/create', 'create')->name('create');
                    Route::post('/', 'store')->name('store');
                    Route::get('/{invoice}/show', 'show')->name('show');
                    Route::get('/{id}/data', 'getInvoiceData')->name('data');

                    // Route::get('/dashboard/business/invoices/{id}/data','getInvoiceData')->name('getInvoiceData');

                    Route::get('/{invoice}/edit', 'edit')->name('edit');
                    Route::get('/{invoice}', 'checkout')->name('pay');
                    Route::put('/{invoice}', 'update')->name('update');
                    Route::put('/mark-as-paid', 'markaspaid')->name('mark-as-paid');
                     Route::delete('/bulk-delete', 'bulkdelete')->name('bulkAction');
                    Route::delete('/{invoice}', 'destroy')->name('destroy'); // Delete invoice
                    Route::get('/{invoice}/download', 'downloadPdf')->name('download');

                    // 🟢 Stripe checkout routes:
                    Route::get('/{invoice}/checkout', 'checkout')->name('checkout');
                    Route::get('/{invoice}/payment-success', 'paymentSuccess')->name('payment.success');
                    Route::get('/{invoice}/payment-cancel', 'paymentCancel')->name('payment.cancel');
                        Route::post('/getinvoicesdata', 'getinvoicesdata')->name('getinvoicesdata');
                });
                Route::get('sms/send', [SmsTwilioController::class, 'sendSms']);
                Route::group([
                    'controller' => \App\Http\Controllers\Business\BookingController::class,
                    'prefix'     => 'bookings',
                    'as'         => 'bookings.',
                ], function () {
                    Route::get('/', 'index')->name('index');               // List bookings
                    Route::get('/create', 'create')->name('create');       // Show create form
                    Route::post('/', 'store')->name('store');              // Store new booking
                    Route::get('/{booking}', 'show')->name('show');        // View single booking
                    Route::get('/{booking}/edit', 'edit')->name('edit');   // Show edit form
                    Route::put('/{booking}', 'update')->name('update');    // Update booking
                    Route::delete('/{booking}', 'destroy')->name('destroy'); // Delete booking
                    Route::put('/mark-as-paid', 'markaspaid')->name('mark-as-paid');
                    Route::put('/mark-as-completed', 'markascompleted')->name('mark-as-completed');
                    Route::put('/bulk-action', 'bulkaction')->name('bulk-action');
                    // ✅ Additional routes
                    Route::get('/{booking}/clients', 'showClients')->name('clients'); // Show clients in booking
                    Route::post('/{booking}/clients', 'addClients')->name('clients.add'); // Add clients to booking
                    Route::delete('/{booking}/clients/{client}', 'removeClient')->name('clients.remove'); // Remove client from booking
                
                    // ✅ Optional routes (e.g. confirm/cancel)
                    Route::post('/{booking}/confirm', 'confirm')->name('confirm'); // Confirm booking
                    Route::post('/{booking}/cancel', 'cancel')->name('cancel');    // Cancel booking
                });
                  Route::group([
                    'controller' => \App\Http\Controllers\Business\BusinessBookingCalendlyController::class,
                    'prefix' => 'calendly',
                    'as' => 'calendly.',
                ], function () {
                    // Existing routes
                    Route::get('/', 'index')->name('index');
                    Route::get('/embed', 'embed')->name('embed');
                    Route::get('/create', 'create')->name('create');
                    Route::post('/', 'store')->name('store');
                    Route::get('/{calendly}', 'show')->name('show');
                    Route::get('/{calendly}/edit', 'edit')->name('edit');
                    Route::put('/{calendly}', 'update')->name('update');
                    Route::delete('/{calendly}', 'destroy')->name('destroy');
                    
                    // Status and action routes
                    Route::put('/mark-as-paid', 'markaspaid')->name('markaspaid');
                    Route::put('/mark-as-completed', 'markascompleted')->name('markascompleted');
                    Route::put('/bulkAction', 'bulkAction')->name('bulkAction');
                    
                    // Clients routes
                    Route::get('/{calendly}/clients', 'showClients')->name('clients');
                    Route::post('/{calendly}/clients', 'addClients')->name('clients.add');
                    Route::delete('/{calendly}/clients/{client}', 'removeClient')->name('clients.remove');
                    
                    // Status routes
                    Route::post('/{calendly}/confirm', 'confirm')->name('confirm');
                    Route::post('/{calendly}/cancel', 'cancel')->name('cancel');
                    
                    // New Calendly integration routes
                    Route::post('/{calendly}/reschedule', 'reschedule')->name('reschedule');
                      Route::post('/getcalendlydata', 'getcalendlydata')->name('getcalendlydata');
                });
                    Route::group([
                        'controller' => \App\Http\Controllers\Business\BusinessTaskController::class,
                        'prefix' => 'task',
                        'as' => 'task.',
                    ], function () {
                        // dd('in');
                        Route::get('/', 'index')->name('index');
                        Route::get('/create', 'create')->name('create');
                        Route::post('/', 'store')->name('store');
                        Route::get('/{task}', 'show')->name('show');
                        Route::get('/{task}/edit', 'edit')->name('edit');
                         Route::post('/{task}/upload-completion-image', 'uploadCompletionImage')->name('uploadCompletionImage');
                        //  Route::post('/{task}/upload-completion-image', 'uploadCompletionImage')->name('uploadCompletionImage');


                        Route::put('/{task}', 'update')->name('update');
                        Route::post('/update-status', 'updateStatus')->name('updateStatus');
                        Route::delete('/{task}', 'destroy')->name('destroy');
                        Route::post('/{task}/comment', 'storeComment')->name('comment.store');
                        Route::delete('/{task}/comment', 'destroyComment')->name('comments.destroy');
                        Route::post('/{task}/attachment', 'storeAttachment')->name('attachment.store');
                        Route::delete('/{task}/attachment', 'destroyAttachment')->name('attachment.destroy');
                        Route::post('/{task}/timer/start', 'startTimer')->name('timer.start');
                        Route::post('/{task}/timer/stop', 'stopTimer')->name('timer.stop');
                        Route::get('/{task}/timer/active', 'activeTimer')->name('timer.active');
                    });
                Route::group([
                    'controller' => AnalyticsController::class,
                    'prefix'     => 'analytics',
                    'as'         => 'analytics.',
                ], function () {
                    Route::get('/', 'index')->name('index');
                });
            });
            Route::prefix('admin')
                ->middleware('admin')
                ->name('admin.')
                ->group(function () {
                    Route::get('/', [AdminController::class, 'index'])->name('index');

                    Route::resource('ai-assistant', AssistantController::class);

                    Route::group([
                        'as'         => 'transfer',
                        'prefix'     => 'transfer',
                        'controller' => CreditsTransferController::class,
                    ], static function () {
                        Route::post('users-credits', 'transferUsersEntityCredits')->name('users.credits');
                        Route::post('users-credits-engine', 'transferUsersEntityCreditsOfEngines')->name('users.credits.engine');
                        Route::post('plans-credits', 'transferPlansEntityCredits')->name('plans.credits');
                        Route::post('plans-credits-engine', 'transferPlansEntityCreditsOfEngines')->name('plans.credits.engine');
                    });

                    Route::group([
                        'as'         => 'chatbot.',
                        'prefix'     => 'chatbot/{chatbot}',
                        'controller' => ChatbotTrainingController::class,
                    ], function () {
                        Route::post('text', 'text')->name('text');
                        Route::post('qa', 'qa')->name('qa');

                        Route::post('training', 'training')->name('training');
                        Route::get('web-sites', 'getWebSites')->name('web-sites');
                        Route::post('web-sites', 'postWebSites');
                        Route::post('upload-pdf', 'uploadPdf')->name('upload-pdf');
                        Route::delete('item/{id}', 'deleteItem')->name('item.delete');
                    });

                    Route::group([
                        'as'     => 'ai-chat-model.',
                        'prefix' => 'ai-chat-model',
                    ], function () {
                        Route::get('', [AiChatbotModelController::class, 'index'])->name('index');
                        Route::post('', [AiChatbotModelController::class, 'update'])->name('update');
                    });

                    Route::group([
                        'as'         => 'chatbot.',
                        'prefix'     => 'chatbot',
                        'controller' => ChatbotController::class,
                    ], function () {
                        Route::get('setting', 'setting')->name('setting');
                        Route::post('setting', 'putSetting');
                        Route::get('external-settings', 'externalChatSettings')->name('external_settings');
                    });

                    Route::resource('chatbot', ChatbotController::class);

                    // Marketplace
                    Route::group([
                        'as'         => 'marketplace.',
                        'prefix'     => 'marketplace',
                        'controller' => MarketPlaceController::class,
                    ], function () {

                        Route::get('cart', [MarketPlaceController::class, 'cart'])->name('cart');

                        Route::get(
                            'cart/{id}/add-delete',
                            [MarketPlaceController::class, 'addDelete']
                        )->name('cart.add-delete');

                        Route::get('', 'index')->name('index');
                        Route::get('licensed-extensions', 'licensedExtension')->name('liextension');
                        Route::get('{slug}', 'extension')->name('extension');
                        Route::get('{slug}/buy', 'buyExtension')->name('buyextesion');
                        Route::get('extension/{token}/activate', 'extensionActivate')->name('activate');
                    });

                    // Themes
                    Route::prefix('themes')->name('themes.')->group(function () {
                        Route::get('', [ThemeController::class, 'index'])->name('index');
                        Route::get('activate/{slug}', [InstallationController::class, 'installTheme'])->name('activate');
                        Route::get('buy/{slug}', [ThemeController::class, 'buyTheme'])->name('buyTheme');
                        Route::get('{token}/activate', [ThemeController::class, 'themeActivate'])->name('paymentActivate');
                    });

                    // User Management
                    Route::prefix('users')->name('users.')->group(function () {
                        Route::get('/', [AdminController::class, 'users'])->name('index');
                        Route::get('/search', [AdminController::class, 'usersSearch'])->name('search');
                        Route::get('/add', [AdminController::class, 'usersAdd'])->name('create');
                        Route::post('/store', [AdminController::class, 'usersStore'])->name('store');
                        Route::get('edit/{user}', [AdminController::class, 'usersEdit'])->name('edit');
                        Route::get('/delete/{id}', [AdminController::class, 'usersDelete'])->name('delete');
                        Route::post('save', [AdminController::class, 'usersSave'])->name('update');

                        Route::get('permissions', [AdminController::class, 'userPermissions'])->name('permissions');
                        Route::post('permission-save', [AdminController::class, 'userPermissionSave'])
                            ->name('permissionSave');

                        Route::get('/finance/{id}', [AdminController::class, 'usersFinance'])->name('finance');

                        Route::get('activity', [AdminController::class, 'usersActivity'])->name('activity');
                        Route::get('dashboard', [AdminController::class, 'usersDashboard'])->name('dashboard');
                        Route::get('export/{type}', [AdminController::class, 'userExport'])->name('userExport');

                        Route::get('deletion/requests', [AdminController::class, 'deletionRequests'])->name('deletion.reqs');
                        Route::post('deletion/requests/{id}', [AdminController::class, 'deletionRequest'])->name('deletion.req');
                    });

                    // Announcements
                    Route::resource('announcements', AnnouncementController::class)->only([
                        'index', 'store',
                    ]);
                    Route::post('announcements/re_notify', [AnnouncementController::class, 're_notify'])->name('announcements.re_notify');
                    Route::post('announcements/reset', [AnnouncementController::class, 'reset'])->name('announcements.reset');

                    // Adsense
                    Route::prefix('adsense')->name('ads.')->group(function () {
                        Route::get('/', [AdsController::class, 'index'])->name('index');
                        Route::get('/{id}/edit', [AdsController::class, 'edit'])->name('edit');
                        Route::put('/{id}', [AdsController::class, 'update'])->name('update');
                        Route::post('/', [AdsController::class, 'store'])->name('store');
                        Route::delete('/{ad}', [AdsController::class, 'destroy'])->name('destroy');
                    });

                    // Bank Transactions
                    Route::prefix('bank')->name('bank.')->group(function () {
                        Route::get('/transactions', [PaymentProcessController::class, 'bankTransactions'])->name('transactions.list');
                        Route::get('/delete/{id?}', [PaymentProcessController::class, 'bankDelete'])->name('transactions.delete');
                        Route::post('/save', [PaymentProcessController::class, 'bankUpdateSave'])->name('transactions.update');
                    });

                    // Openai management
                    Route::prefix('openai')->name('openai.')->group(function () {
                        Route::get('/', [AdminController::class, 'openAIList'])->name('list');
                        Route::post('/update-status', [AdminController::class, 'openAIListUpdateStatus']);
                        Route::post('/update-package-status', [AdminController::class, 'openAIListUpdatePackageStatus']);

                        Route::prefix('custom')->name('custom.')->group(function () {
                            Route::get('/', [AdminController::class, 'openAICustomList'])->name('list');
                            Route::get('/add-or-update/{id?}', [AdminController::class, 'openAICustomAddOrUpdate'])->name('addOrUpdate');
                            Route::get('/delete/{id?}', [AdminController::class, 'openAICustomDelete'])->name('delete');
                            Route::post('/save', [AdminController::class, 'openAICustomAddOrUpdateSave']);
                        });

                        Route::prefix('categories')->name('categories.')->group(function () {
                            Route::get('/', [AdminController::class, 'openAICategoriesList'])->name('list');
                            Route::get('/add-or-update/{id?}', [AdminController::class, 'openAICategoriesAddOrUpdate'])->name('addOrUpdate');
                            Route::get('/delete/{id?}', [AdminController::class, 'openAICategoriesDelete'])->name('delete');
                            Route::post('/save', [AdminController::class, 'openAICategoriesAddOrUpdateSave']);
                        });

                        Route::prefix('chat')->name('chat.')->group(function () {
                            Route::get('/', [AdminController::class, 'openAIChatList'])->name('list');
                            Route::get('/add-or-update/{id?}', [AdminController::class, 'openAIChatAddOrUpdate'])->name('addOrUpdate');
                            Route::get('/delete/{id?}', [AdminController::class, 'openAIChatDelete'])->name('delete');
                            Route::post('/save', [AdminController::class, 'openAIChatAddOrUpdateSave'])->name('save');

                            Route::post('/update-plan', [AdminController::class, 'updatePlan'])->name('updatePlan');

                            Route::post('/update-fav', [AdminController::class, 'updateChatFav'])->name('updateChatFav');

                            Route::get('/category', [AdminController::class, 'categoryList'])->name('category');
                            Route::get('/category/add-or-update/{id?}', [AdminController::class, 'addOrUpdateCategory'])->name('addOrUpdateCategory');
                            Route::post('/category/save', [AdminController::class, 'chatCategoriesAddOrUpdateSave']);
                            Route::get('/category/delete/{id?}', [AdminController::class, 'chatCategoriesDelete'])->name('deleteCategory');
                        });
                    });

                    // Finance
                    Route::prefix('finance')->name('finance.')->group(function () {

                        Route::resource('plan', PlanController::class)->except(
                            'store', 'update', 'destroy', 'show'
                        );

                        Route::get('plan/{plan}/delete', [PlanController::class, 'destroy'])->name('plan.destroy');

                        Route::resource('token-pack-plan', TokenPackPlanController::class)->only(
                            'create', 'edit'
                        );

                        // Plans
                        Route::get('free-feature', [AdminController::class, 'freeFeature'])->name('free.feature');
                        Route::post('free-feature', [AdminController::class, 'freeFeatureSave']);
                        Route::prefix('plans')->name('plans.')->group(function () {
                            Route::get('/', [AdminController::class, 'paymentPlans'])->name('index');
                            Route::get('/subscription/create-or-update/{id?}', [AdminController::class, 'paymentPlansSubscriptionNewOrEdit'])->name('SubscriptionNewOrEdit');
                            Route::get('/pre-paid/create-or-update/{id?}', [AdminController::class, 'paymentPlansPrepaidNewOrEdit'])->name('PlanNewOrEdit');
                            Route::get('/delete/{id}', [AdminController::class, 'paymentPlansDelete'])->name('delete');
                            Route::post('/save', [AdminController::class, 'paymentPlansSave'])->name('save');
                        });

                        // Payment Gateways
                        Route::prefix('paymentGatewaysadd')->name('paymentGateways.')->group(function () {
                            Route::get('/', [GatewayController::class, 'paymentGateways'])->name('index');
                            Route::get('/settings/{code}', [GatewayController::class, 'gatewaySettings'])->name('settings');
                            Route::post('/settings/country-tax-enabled/{code}', [GatewayController::class, 'countryTaxEnabled'])->name('country.tax.enabled');
                            Route::post('/settings/save', [GatewayController::class, 'gatewaySettingsSave'])->name('settings.save');
                            Route::post('/settings/tax/save', [GatewayController::class, 'gatewaySettingsTaxSave'])->name('settings.tax.save');
                            Route::get('/settings/tax/delete/{id}', [GatewayController::class, 'gatewaySettingsTaxDelete'])->name('settings.tax.delete');
                        });
                        // Mobile
                        Route::prefix('mobile')->name('mobile.')->group(function () {
                            Route::match(['get', 'post'], '/', [MobilePaymentsController::class, 'mobilePlanIdSettings'])->name('index');
                        });
                        // API Cost
                        Route::prefix('api-cost-management')->name('api-cost-management.')->group(function () {
                            Route::get('/', [ApiCostController::class, 'index'])->name('index');
                            Route::post('/update', [ApiCostController::class, 'update'])->name('update');
                        });
                    });

                    // Testimonials
                    Route::prefix('testimonials')->name('testimonials.')->group(function () {
                        Route::get('/', [AdminController::class, 'testimonials'])->name('index');
                        Route::get('/create-or-update/{id?}', [AdminController::class, 'testimonialsNewOrEdit'])->name('TestimonialsNewOrEdit');
                        Route::get('/delete/{id}', [AdminController::class, 'testimonialsDelete'])->name('delete');
                        Route::post('/save', [AdminController::class, 'testimonialsSave']);
                    });

                    // Clients
                    Route::prefix('clients')->name('clients.')->group(function () {
                        Route::get('/', [AdminController::class, 'clients'])->name('index');
                        Route::get('/create-or-update/{id?}', [AdminController::class, 'clientsNewOrEdit'])->name('ClientsNewOrEdit');
                        Route::get('/delete/{id}', [AdminController::class, 'clientsDelete'])->name('delete');
                        Route::post('/save', [AdminController::class, 'clientsSave']);
                    });

                    // How it Works
                    Route::prefix('howitWorks')->name('howitWorks.')->group(function () {
                        Route::get('/', [AdminController::class, 'howitWorks'])->name('index');
                        Route::get('/create-or-update/{id?}', [AdminController::class, 'howitWorksNewOrEdit'])->name('HowitWorksNewOrEdit');
                        Route::get('/delete/{id}', [AdminController::class, 'howitWorksDelete'])->name('delete');
                        Route::post('/save', [AdminController::class, 'howitWorksSave']);
                        Route::post('/bottom-line', [AdminController::class, 'howitWorksBottomLineSave']);
                    });

                    Route::group([
                        'prefix' => 'config',
                        'as'     => 'config.',
                    ], function () {
                        Route::post('smtp/test', [SmtpController::class, 'test'])->name('smtp.test');
                        Route::resource('more', MoreController::class)->only(['index', 'store']);
                        Route::resource('seo', SeoController::class)->only(['index', 'store']);
                        Route::resource('ai-tools', AiToolsController::class)->only(['index', 'store']);
                        Route::resource('finance', FinanceController::class)->only(['index', 'store']);
                        Route::resource('smtp', SmtpController::class)->only(['index', 'store']);
                        Route::resource('login', LoginController::class)->only(['index', 'store']);
                        Route::resource('gdpr', GdprController::class)->only(['index', 'store']);
                        Route::resource('storage', StorageController::class)->only(['index', 'store']);
                        Route::resource('branding', BrandingController::class)->only(['index', 'store']);
                        Route::post('branding/favicon', [BrandingController::class, 'favicon'])->name('branding.favicon');
                        Route::resource('', GeneralController::class)->parameter('', 'id')->only(['index']);
                    });

                    // Settings
                    Route::prefix('settings')->name('settings.')->group(function () {
                        Route::get('/general', [SettingsController::class, 'general'])->name('general');
                        Route::post('/general-save', [SettingsController::class, 'generalSave']);

                        Route::get('searchapi', [SearchapiSettingController::class, 'index'])->name('searchapi');
                        Route::post('searchapi', [SearchapiSettingController::class, 'update']);

                        Route::get('/openai', [SettingsController::class, 'openai'])->name('openai');
                        Route::get('/openai/test', [SettingsController::class, 'openaiTest'])->name('openai.test');
                        Route::post('/openai-save', [SettingsController::class, 'openaiSave']);

                        Route::get('anthropic', [SettingsController::class, 'anthropic'])->name('anthropic');
                        Route::get('anthropic/test', [SettingsController::class, 'anthropicTest'])->name('anthropic.test');
                        Route::post('anthropic', [SettingsController::class, 'anthropicSave']);

                        Route::get('deepseek', [SettingsController::class, 'deepseek'])->name('deepseek');
                        Route::get('deepseek/test', [SettingsController::class, 'deepseekTest'])->name('deepseek.test');
                        Route::post('deepseek', [SettingsController::class, 'deepseekSave'])->name('deepseek.save');

                        Route::get('gemini', [SettingsController::class, 'gemini'])->name('gemini');
                        Route::get('gemini/test', [SettingsController::class, 'geminiTest'])->name('gemini.test');
                        Route::post('gemini', [SettingsController::class, 'geminiSave']);

                        Route::get('/stablediffusion', [SettingsController::class, 'stablediffusion'])->name('stablediffusion');
                        Route::get('/stablediffusion/test', [SettingsController::class, 'stablediffusionTest'])->name('stablediffusion.test');
                        Route::post('/stablediffusion-save', [SettingsController::class, 'stablediffusionSave']);

                        Route::get('/unsplashapi', [SettingsController::class, 'unsplashapi'])->name('unsplashapi');
                        Route::get('/unsplashapi/test', [SettingsController::class, 'unsplashapiTest'])->name('unsplashapi.test');
                        Route::post('/unsplashapi-save', [SettingsController::class, 'unsplashapiSave']);

                        Route::get('/pexelsapi', [SettingsController::class, 'pexelsapi'])->name('pexelsapi');
                        Route::get('/pexelsapi/test', [SettingsController::class, 'pexelsapiTest'])->name('pexelsapi.test');
                        Route::post('/pexelsapi-save', [SettingsController::class, 'pexelsapiSave']);

                        Route::get('/pixabayapi', [SettingsController::class, 'pixabayapi'])->name('pixabayapi');
                        Route::get('/pixabayapi/test', [SettingsController::class, 'pixabayapiTest'])->name('pixabayapi.test');
                        Route::post('/pixabayapi-save', [SettingsController::class, 'pixabayapiSave']);

                        // thumbnail system
                        Route::get('/thumbnail', [SettingsController::class, 'thumbnail'])->name('thumbnail');
                        Route::post('/thumbnail-save', [SettingsController::class, 'thumbnailSave'])->name('thumbnail.save');
                        Route::post('/thumbnail-purge', [SettingsController::class, 'thumbnailPurge'])->name('thumbnail.purge');

                        Route::get('/serperapi', [SettingsController::class, 'serperapi'])->name('serperapi');
                        Route::get('/serperapi/test', [SettingsController::class, 'serperapiTest'])->name('serperapi.test');
                        Route::post('/serperapi-save', [SettingsController::class, 'serperapiSave']);

                        Route::get('/tts', [SettingsController::class, 'tts'])->name('tts');
                        Route::post('/tts-save', [SettingsController::class, 'ttsSave']);

                        Route::get('/payment', [SettingsController::class, 'payment'])->name('payment');
                        Route::post('/payment-save', [SettingsController::class, 'paymentSave']);

                        Route::post('/affiliate-status-save/{id}', [SettingsController::class, 'affiliateStatusSave']);

                        Route::get('/privacy', [SettingsController::class, 'privacy'])->name('privacy');
                        Route::post('/privacy-save', [SettingsController::class, 'privacySave']);

                        Route::post('/get-privacy-terms-content', [SettingsController::class, 'getPrivacyTermsContent']);
                        Route::post('/get-meta-content', [SettingsController::class, 'getMetaContent']);
                    });

                    // Affiliates
                    Route::prefix('affiliates')->name('affiliates.')->group(function () {
                        Route::get('/', [AdminController::class, 'affiliatesList'])->name('index');
                        Route::get('/sent/{id}', [AdminController::class, 'affiliatesListSent'])->name('sent');
                    });

                    // Coupons
                    Route::prefix('coupons')->name('coupons.')->group(function () {
                        Route::get('/', [AdminController::class, 'couponsList'])->name('index');
                        Route::get('/used/{id}', [AdminController::class, 'couponsListUsed'])->name('used');
                        Route::get('/delete/{id}', [AdminController::class, 'couponsDelete'])->name('delete');
                        Route::post('/edit/{id}', [AdminController::class, 'couponsEdit'])->name('edit');
                        Route::post('/add', [AdminController::class, 'couponsAdd'])->name('add');
                    });

                    // Frontend
                    Route::prefix('frontend')->name('frontend.')->group(function () {
                        Route::get('/', [AdminController::class, 'frontendSettings'])->name('settings');
                        Route::post('/settings-save', [AdminController::class, 'frontendSettingsSave']);

                        Route::get('/section-settings', [AdminController::class, 'frontendSectionSettings'])->name('sectionsettings');
                        Route::post('/section-settings-save', [AdminController::class, 'frontendSectionSettingsSave']);

                        Route::get('/menu', [AdminController::class, 'menuSettings'])->name('menusettings');
                        Route::post('/menu-save', [AdminController::class, 'menuSettingsSave']);

                        Route::get('/auth', [AdminController::class, 'authSettings'])->name('authsettings');
                        Route::post('/auth-save', [AdminController::class, 'authsettingsSave']);

                        // Frequently Asked Questions (F.A.Q) Section faq
                        Route::prefix('faq')->name('faq.')->group(function () {
                            Route::get('/', [AdminController::class, 'frontendFaq'])->name('index');
                            Route::get('/create-or-update/{id?}', [AdminController::class, 'frontendFaqcreateOrUpdate'])->name('createOrUpdate');
                            Route::get('/action/delete/{id}', [AdminController::class, 'frontendFaqDelete'])->name('delete');
                            Route::post('/action/save', [AdminController::class, 'frontendFaqcreateOrUpdateSave']);
                        });

                        // Tools Section
                        Route::prefix('tools')->name('tools.')->group(function () {
                            Route::get('/', [AdminController::class, 'frontendTools'])->name('index');
                            Route::get('/create-or-update/{id?}', [AdminController::class, 'frontendToolscreateOrUpdate'])->name('createOrUpdate');
                            Route::get('/action/delete/{id}', [AdminController::class, 'frontendToolsDelete'])->name('delete');
                            Route::post('/action/save', [AdminController::class, 'frontendToolscreateOrUpdateSave']);
                        });

                        // Future of ai section Features
                        Route::prefix('future')->name('future.')->group(function () {
                            Route::get('/', [AdminController::class, 'frontendFuture'])->name('index');
                            Route::get('/create-or-update/{id?}', [AdminController::class, 'frontendFutureCreateOrUpdate'])->name('createOrUpdate');
                            Route::get('/action/delete/{id}', [AdminController::class, 'frontendFutureDelete'])->name('delete');
                            Route::post('/action/save', [AdminController::class, 'frontendFutureCreateOrUpdateSave']);
                        });

                        // who is this script for?
                        Route::prefix('whois')->name('whois.')->group(function () {
                            Route::get('/', [AdminController::class, 'frontendWhois'])->name('index');
                            Route::get('/create-or-update/{id?}', [AdminController::class, 'frontendWhoisCreateOrUpdate'])->name('createOrUpdate');
                            Route::get('/action/delete/{id}', [AdminController::class, 'frontendWhoisDelete'])->name('delete');
                            Route::post('/action/save', [AdminController::class, 'frontendWhoisCreateOrUpdateSave']);
                        });

                        // Generator List
                        Route::prefix('generatorlist')->name('generatorlist.')->group(function () {
                            Route::get('/', [AdminController::class, 'frontendGeneratorlist'])->name('index');
                            Route::get('/create-or-update/{id?}', [AdminController::class, 'frontendGeneratorlistCreateOrUpdate'])->name('createOrUpdate');
                            Route::get('/action/delete/{id}', [AdminController::class, 'frontendGeneratorlistDelete'])->name('delete');
                            Route::post('/action/save', [AdminController::class, 'frontendGeneratorlistCreateOrUpdateSave']);
                        });

                        // socialmedia
                        Route::get('/socialmedia', [AdminController::class, 'socialmedia'])->name('socialmedia');
                        Route::post('/socialmedia', [AdminController::class, 'socialmediaSave'])->name('socialmedia.save');
                    });

                    Route::resource('advertis', AdvertisController::class)->parameter('advertis', 'advertis');

                    // Update
                    Route::view('update', 'panel.admin.update.index')->name('update.index');

                    // Healt Page
                    Route::prefix('health')
                        ->name('health.')
                        ->group(function () {
                            Route::get('', [HealthController::class, 'index'])->name('index');
                            Route::get('logs', [HealthController::class, 'logs'])->name('logs');
                            // cache clear
                            Route::get('cache-clear', [HealthController::class, 'cacheClear'])->name('cache.clear');
                        });
                    Route::view('license', 'panel.admin.license.index')->name('license.index');

                    Route::post('translations/auto/{lang}', [TranslateController::class, 'autoTranslate'])->name('translations.auto');
                });

            // Coupons
            Route::prefix('coupons')->name('coupons.')->group(function () {
                Route::post('/validate-coupon', [AdminController::class, 'couponsValidate'])->name('validate');
            });

            Route::post('change-chat-title', [AIChatController::class, 'changeChatTitle'])->name('change-chat-title');

            // Support Area
            Route::prefix('support')->name('support.')->group(function () {
                Route::get('/my-requests', [SupportController::class, 'list'])->name('list')->middleware(CheckTemplateTypeAndPlan::class);
                Route::get('/new-support-request', [SupportController::class, 'newTicket'])->name('new');
                Route::post('/new-support-request/send', [SupportController::class, 'newTicketSend']);

                Route::get('/requests/{ticket_id}', [SupportController::class, 'viewTicket'])->name('view');
                Route::post('/requests-action/send-message', [SupportController::class, 'viewTicketSendMessage']);
            });

            // Admin Area2
            Route::middleware('admin')
                ->group(function () {
                    // Pages
                    Route::prefix('page')->name('page.')->group(function () {
                        Route::get('/', [PageController::class, 'pageList'])->name('list');
                        Route::get('/add-or-update/{id?}', [PageController::class, 'pageAddOrUpdate'])->name('addOrUpdate');
                        Route::get('/delete/{id?}', [PageController::class, 'pageDelete'])->name('delete');
                        Route::post('/save', [PageController::class, 'pageAddOrUpdateSave']);
                    });

                    // Email Templates
                    Route::get('email-templates/{id}/send', [EmailTemplatesController::class, 'sendView'])
                        ->name('email-templates.send');

                    Route::post('email-templates/{id}/send', [EmailTemplatesController::class, 'sendQueue']);

                    Route::resource('email-templates', EmailTemplatesController::class);
                    // delete email template route
                    Route::get('email-templates/{id}/delete', [EmailTemplatesController::class, 'delete'])
                        ->name('email-templates.destroy');

                    // Blog
                    Route::prefix('blog')->name('blog.')->group(function () {
                        Route::get('/', [BlogController::class, 'blogList'])->name('list');
                        Route::get('/add-or-update/{id?}', [BlogController::class, 'blogAddOrUpdate'])->name('addOrUpdate');
                        Route::get('/delete/{id?}', [BlogController::class, 'blogDelete'])->name('delete');
                        Route::post('/save', [BlogController::class, 'blogAddOrUpdateSave']);
                    });
                });

            // Notifications
            Route::post('notifications/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAllAsRead');

            // Chatbot
            Route::prefix('chatbot')->name('chatbot.')->group(function () {
                Route::get('/', [\App\Http\Controllers\Chatbot\ChatbotController::class, 'index'])->name('index');
                Route::get('/add-or-update/{id?}', [\App\Http\Controllers\Chatbot\ChatbotController::class, 'addOrUpdate'])->name('addOrUpdate');
                Route::get('/delete/{id?}', [\App\Http\Controllers\Chatbot\ChatbotController::class, 'delete'])->name('delete');
                Route::post('/save', [\App\Http\Controllers\Chatbot\ChatbotController::class, 'addOrUpdateSave']);
                Route::post('/save-settings', [\App\Http\Controllers\Chatbot\ChatbotController::class, 'chatbotSettingsSave']);
            });

            // Search
            Route::post('/api/search', [SearchController::class, 'search']);
        });

    Route::group(['prefix' => config('elseyyid-location.prefix'), 'middleware' => config('elseyyid-location.middlewares'), 'as' => 'elseyyid.translations.'], function () {
        Route::get('home', '\Elseyyid\LaravelJsonLocationsManager\Controllers\HomeController@index')->name('home');
        Route::get('lang/{lang}', '\Elseyyid\LaravelJsonLocationsManager\Controllers\HomeController@lang')->name('lang');
        Route::get('lang/generateJson/{lang}', '\Elseyyid\LaravelJsonLocationsManager\Controllers\HomeController@generateJson')->name('lang.generateJson');
        Route::get('newLang', '\Elseyyid\LaravelJsonLocationsManager\Controllers\HomeController@newLang')->name('lang.newLang');
        Route::get('newString', '\Elseyyid\LaravelJsonLocationsManager\Controllers\HomeController@newString')->name('lang.newString');
        Route::get('search', '\Elseyyid\LaravelJsonLocationsManager\Controllers\HomeController@search')->name('lang.search');
        Route::get('string/{code}', '\Elseyyid\LaravelJsonLocationsManager\Controllers\HomeController@string')->name('lang.string');
        Route::get('publish-all', '\Elseyyid\LaravelJsonLocationsManager\Controllers\HomeController@publishAll')->name('lang.publishAll');

        // Reinstall
        Route::get('regenerate', function () {
            Artisan::call('elseyyid:location:install');

            return redirect()->route('elseyyid.translations.home')->with(config('elseyyid-location.message_flash_variable'), __('Language files regenerated!'));
        })->name('lang.reinstall');

        // setLocale
        Route::get('setLocale', function (\Illuminate\Http\Request $request) {
            $settings_two = \App\Models\SettingTwo::getCache();
            $settings_two->languages_default = $request->setLocale;
            $settings_two->save();
            LaravelLocalization::setLocale($request->setLocale);

            return redirect()->route('elseyyid.translations.home', [$request->setLocale])->with(config('elseyyid-location.message_flash_variable'), $request->setLocale);
        })->name('lang.setLocale');
    });
// routes/api.php
    Route::post('/calendly/webhook', [\App\Http\Controllers\Business\BusinessBookingCalendlyWebhookController::class, 'handleWebhook']);
// routes/web.php or routes/api.php
     Route::get('/calendly/register-webhook', [\App\Http\Controllers\Business\BusinessBookingCalendlyController::class, 'registerCalendlyWebhook']);

    Route::post('translations/lang/update/{id}', '\Elseyyid\LaravelJsonLocationsManager\Controllers\HomeController@update')->name('elseyyid.translations.lang.update');

    Route::post('translations/lang/update-all', [CommonController::class, 'translationsLangUpdateAll'])
        ->name('elseyyid.translations.lang.update-all');

    Route::post('translations/lang-save', [CommonController::class, 'translationsLangSave'])->name('elseyyid.translations.lang.lang-save');

    Route::post('image/upload', [CommonController::class, 'imageUpload'])->name('upload.image');

    Route::post('images/upload', [CommonController::class, 'imagesUpload'])->name('upload.images');

    Route::post('pdf/getContent', [ChatPdfController::class, 'getSimiliarContent'])->name('pdf.getcontent');

    Route::post('rss/fetch', [CommonController::class, 'rssFetch'])->name('rss.fetch');

    $files = glob(base_path('routes/extroutes/*.php'));
    for ($i = 0; $i < count($files); $i++) {
        include $files[$i];
    }

    Route::middleware('auth')
        ->group(function () {
            Route::middleware('admin')->get('/debug', function () {
                $currentDebugValue = env('APP_DEBUG', false);
                $newDebugValue = ! $currentDebugValue;
                $envContent = file_get_contents(base_path('.env'));
                $envContent = preg_replace('/^APP_DEBUG=.*/m', 'APP_DEBUG=' . ($newDebugValue ? 'true' : 'false'), $envContent);
                file_put_contents(base_path('.env'), $envContent);
                Artisan::call('config:clear');

                return redirect()->back()->with('message', 'Debug mode updated successfully.');
            });

            Route::get('/check-vip-status', static function () {
                return response()->json([
                    'showIntercom' => \App\Helpers\Classes\Helper::showIntercomForVipMembership(),
                ]);
            });
            Route::get('/vip-intercom-partial', static function () {
                return view('panel.layout.includes.vip-intercom');
            });
        });

    if (file_exists(base_path('routes/custom_routes_panel.php'))) {
        include base_path('routes/custom_routes_panel.php');
    }
});
