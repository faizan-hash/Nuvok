<?php $__env->startSection('content'); ?>
    <style>
        .login-container {
            background: linear-gradient(135deg, #f0f4f8, #d1e0ed);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-box {
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: 1rem;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            padding: 2rem;
            width: 100%;
            max-width: 28rem;
        }
        .logo-container {
            transition: transform 0.3s ease;
        }
        .logo-container:hover {
            transform: scale(1.05);
        }
        .welcome-text {
            background: linear-gradient(90deg, #3b82f6, #8b5cf6);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        .hide-sign-text .btn-primary,
        .hide-sign-text .btn-secondary {
            font-size: 0;
        }
        .hide-sign-text .btn-primary::after,
        .hide-sign-text .btn-secondary::after {
            font-size: 1rem;
            content: 'Continue';
        }
        .btn-primary {
            font-size: 0;
        }
        .btn-primary::after {
            content: 'Continue';
            font-size: 1rem;
        }
        .text-center a {
            display: none;
        }
    </style>

    <body class="light">
        <div class="login-container text-gray-800">
            <div class="login-box">
                <div class="logo-container mb-8">
                    <a class="navbar-brand flex items-center justify-center mb-4" href="<?php echo e(route('index')); ?>">
                        <?php if(isset($setting->logo_dashboard) && isset($setting->logo_dashboard_path)): ?>
                            <img class="h-12 w-auto"
                                src="<?php echo e(custom_theme_url($setting->logo_dashboard_path, true)); ?>"
                                <?php if(isset($setting->logo_dashboard_2x_path) && !empty($setting->logo_dashboard_2x_path)): ?> srcset="/<?php echo e($setting->logo_dashboard_2x_path); ?> 2x" <?php endif; ?>
                                alt="<?php echo e($setting->site_name); ?>">
                        <?php else: ?>
                            <img class="h-12 w-auto"
                                src="<?php echo e(custom_theme_url($setting->logo_path, true)); ?>"
                                <?php if(isset($setting->logo_2x_path) && !empty($setting->logo_2x_path)): ?> srcset="/<?php echo e($setting->logo_2x_path); ?> 2x" <?php endif; ?>
                                alt="<?php echo e($setting->site_name); ?>">
                        <?php endif; ?>
                    </a>
                </div>
                <div class="login-form hide-sign-text">
                    <?php echo $__env->yieldContent('form'); ?>
                </div>
            </div>
        </div>
    </body>

    <script>
        // Remove the specific image element by its class
        document.addEventListener('DOMContentLoaded', function () {
            var imgElement = document.querySelector('.translate-x-\\[27\\%\\]');
            if (imgElement) {
                imgElement.remove();
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('panel.layout.app', ['layout_wide' => true, 'wide_layout_px' => 'px-0'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/Novuk/resources/views/default/panel/authentication/layout/app.blade.php ENDPATH**/ ?>