<?php $__env->startSection('title', __('AI Estimator')); ?>
<?php $__env->startSection('titlebar_actions'); ?>    
 <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve(['variant' => 'link','href' => ''.e(LaravelLocalization::localizeUrl(route('dashboard.index'))).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'text-inherit hover:text-foreground']); ?>
    <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('tabler-chevron-left'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(BladeUI\Icons\Components\Svg::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'size-4','stroke-width' => '1.5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $attributes = $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $component = $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
    <?php echo e(__('Back to dashboard')); ?>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale67687e3e4e61f963b25a6bcf3983629)): ?>
<?php $attributes = $__attributesOriginale67687e3e4e61f963b25a6bcf3983629; ?>
<?php unset($__attributesOriginale67687e3e4e61f963b25a6bcf3983629); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale67687e3e4e61f963b25a6bcf3983629)): ?>
<?php $component = $__componentOriginale67687e3e4e61f963b25a6bcf3983629; ?>
<?php unset($__componentOriginale67687e3e4e61f963b25a6bcf3983629); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('additional_css'); ?>
    <style>
        .task-form-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 30px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        body.dark .task-form-container {
            background: #171B21;
        }
        .form-header {
            margin-bottom: 30px;
            text-align: center;
        }
        .form-header h2 {
            font-size: 24px;
            font-weight: 600;
            color: #1f2937;
        }
        body.dark .form-header h2 {
            color: #ffffff;
        }
        .form-group {
            margin-bottom: 25px;
        }
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #374151;
        }
        body.dark .form-label {
            color: #e5e7eb;
        }
        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
            background-color: #ffffff;
            color: #1f2937;
        }
        .form-control:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        body.dark .form-control {
            background-color: #1f2937;
            color: #f9fafb;
            border-color: #374151;
        }
        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }
        .submit-btn {
            width: 100%;
            padding: 14px;
            background-color: #3b82f6;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .submit-btn:hover {
            background-color: #6EE7B7;
            color: #1C2A39;
        }
        .input-group {
            position: relative;
        }
        .input-group .icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
        }
        .input-group .form-control {
            padding-left: 40px;
        }
        .input-group .currency {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
        }
        .error-message {
            color: #ef4444;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('settings'); ?>
    <div class="task-form-container">
        <div class="form-header">
            <h2 class="dark:text-white"><?php echo e(__('Describe Your Task or Project')); ?></h2>
        </div>

      <form id="estimation-form" method="POST" action="<?php echo e(route('dashboard.business.ai-estimator.task.estimate')); ?>">
        <?php echo csrf_field(); ?>

        <!-- Task Information -->
        <div class="form-group">
            <label for="task_information" class="form-label">Description</label>
            <textarea id="task_information" name="task_information" class="form-control" required></textarea>
            <?php $__errorArgs = ['task_information'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="error-message"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Labour Amount -->
        <div class="form-group">
            <label for="number_of_people" class="form-label">Number of People Required</label>
            <input type="number" id="number_of_people" name="number_of_people" class="form-control" min="1" step="1" required>
            <?php $__errorArgs = ['number_of_people'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="error-message"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Time Required -->
        <div class="form-group">
            <label for="time_required" class="form-label">Time Required (hours)</label>
            <input type="number" id="time_required" name="time_required" class="form-control" min="0.5" step="0.5" required>
            <?php $__errorArgs = ['time_required'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="error-message"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="btn-container">
            <button type="submit" class="submit-btn bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md">
               Estimate Price
            </button>
        </div>
        <!-- Submit -->
        <!--<button type="submit" class="submit-btn dark:text-white">Estimate Price</button>-->
    </form>

    <!-- Display Result -->
    <div id="estimated-price-result" style="margin-top: 15px; font-weight: bold;"></div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('additional_scripts'); ?>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('estimation-form');
        const resultDiv = document.getElementById('estimated-price-result');

        form.addEventListener('submit', function (e) {
            e.preventDefault();
            resultDiv.innerHTML = '⏳ Estimating...';

            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    resultDiv.innerHTML = `💰 Estimated Price: <strong>$${data.estimated_price}</strong>`;
                } else {
                    resultDiv.innerHTML = '⚠️ Failed to estimate. Please try again.';
                }
            })
            .catch(error => {
                console.error(error);
                resultDiv.innerHTML = '❌ Error occurred while estimating.';
            });
        });
    });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('panel.layout.settings', ['layout' => 'fullwidth'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/Novuk/resources/views/default/panel/business/AiEstimator/index.blade.php ENDPATH**/ ?>