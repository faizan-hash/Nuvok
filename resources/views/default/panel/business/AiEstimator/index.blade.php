@extends('panel.layout.settings', ['layout' => 'fullwidth'])

@section('title', __('AI Estimator'))
@section('titlebar_actions')    
 <x-button
    class="text-inherit hover:text-foreground"
    variant="link"
    href="{{ LaravelLocalization::localizeUrl(route('dashboard.index')) }}"
>
    <x-tabler-chevron-left
        class="size-4"
        stroke-width="1.5"
    />
    {{ __('Back to dashboard') }}
</x-button>
@endsection

@section('additional_css')
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
@endsection

@section('settings')
    <div class="task-form-container">
        <div class="form-header">
            <h2 class="dark:text-white">{{ __('Describe Your Task or Project') }}</h2>
        </div>

      <form id="estimation-form" method="POST" action="{{ route('dashboard.business.ai-estimator.task.estimate') }}">
        @csrf

        <!-- Task Information -->
        <div class="form-group">
            <label for="task_information" class="form-label">Description</label>
            <textarea id="task_information" name="task_information" class="form-control" required></textarea>
            @error('task_information')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Labour Amount -->
        <div class="form-group">
            <label for="number_of_people" class="form-label">Number of People Required</label>
            <input type="number" id="number_of_people" name="number_of_people" class="form-control" min="1" step="1" required>
            @error('number_of_people')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Time Required -->
        <div class="form-group">
            <label for="time_required" class="form-label">Time Required (hours)</label>
            <input type="number" id="time_required" name="time_required" class="form-control" min="0.5" step="0.5" required>
            @error('time_required')
                <span class="error-message">{{ $message }}</span>
            @enderror
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
@endsection

@section('additional_scripts')
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
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
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
@endsection
