<!-- Core Libraries -->
<script src="<?php echo e(custom_theme_url('/assets/libs/jquery/jquery.min.js')); ?>"></script> <!-- v3.7.1 -->
<script src="<?php echo e(custom_theme_url('/assets/libs/toastr/toastr.min.js')); ?>"></script>
<!-- Tailwind CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>


<!-- DataTables Core + Extensions -->

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>

<!-- Other UI Libraries -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<style>
 #toast-container.toast-top-custom {
    position: fixed !important;
    top: 4rem !important;
    right: 1.5rem !important;
    bottom: unset !important;
    left: unset !important;
    transform: none !important;
    margin: 0 !important;
    padding: 0 !important;
    z-index: 99999 !important;
    width: auto !important;
}

#toast-container.toast-top-custom .toast {
    margin-bottom: 0.5rem !important;
}

  /*.toast-success {*/
  /*          top: auto !important;*/
  /*          bottom: 50px !important;*/
  /*          left: 50% !important;*/
  /*          transform: translateX(-50%);*/
  /*          position: fixed !important;*/
  /*          z-index: 9999;*/
  /*      }*/
body.theme-dark .task-form-container
{
    background-color: #171B21;
}
body.theme-dark .form-header
{
    color: #ffffff;
}

body.theme-dark #job_steps_container {
    background-color: #171B21;
    color: #e5e7eb;
    border-color: #4b5563;
}

/* ===========================
   🌙 Dark Mode Styles - #171B21 Base
=========================== */

body.theme-dark {
    background-color: #171B21;
    color: #e5e7eb;
}

/* === Form Elements === */
body.theme-dark input,
body.theme-dark select,
body.theme-dark textarea {
    background-color: #171B21;
    color: #8a919e;
    border-color: #4b5563;
}

/* === Select2 Styles === */
body.theme-dark .select2-selection {
    background-color: #171B21 !important;
    color: #e5e7eb !important;
    border-color: #4b5563 !important;
}

body.theme-dark .select2-results__option {
    background-color: #171B21 !important;
    color: #e5e7eb !important;
}

/* === DataTable Table === */
body.theme-dark table {
    color: #e5e7eb;
    border-color: #2a2e35;
}

body.theme-dark table thead {
    background-color: #1d2127;
    color: #ffffff;
}

body.theme-dark table.dataTable tbody tr {
    background-color: #171B21 !important;
    color: #e5e7eb !important;
}

body.theme-dark table.dataTable tbody tr:hover {
    background-color: #252A31 !important;
    color: #ffffff !important;
}

/* Remove even/odd striping if needed */
body.theme-dark table.dataTable tbody tr.even,
body.theme-dark table.dataTable tbody tr.odd {
    background-color: #171B21 !important;
    color: #e5e7eb !important;
}

/* === DataTable Pagination Buttons === */
body.theme-dark .dataTables_wrapper .dataTables_paginate .paginate_button {
    background-color: transparent !important;
    color: #e5e7eb !important;
    border: none !important;
}

body.theme-dark .dataTables_wrapper .dataTables_paginate .paginate_button.current,
body.theme-dark .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background-color: #6EE7B7 !important;
    color: #ffffff !important;
}

/* === Optional: Action icons, buttons, etc. === */
body.theme-dark .actions i {
    color: #ffffff;
}

body.theme-dark .lqd-page-content-container {
    background-color: #171B21;
    color: #e5e7eb;
}
body.theme-dark .lqd-titlebar-title {
    
    color: #ffffff;
}



/* 🌙 Dark Mode Styling */
body.theme-dark .kanban-board {
    background-color: transparent;
}

body.theme-dark .kanban-column {
    background-color: #1e2329; /* darker background */
    border-color: #2e343b;
}

body.theme-dark .kanban-column h3 {
    /*background-color: #1a1d22;*/
    color: #ffffff;
}

body.theme-dark .task-card {
    background-color: #262b31;
    border-color: #3a4048;
    color: #e5e7eb;
}

body.theme-dark .task-card:hover {
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
}

/* 🌓 Scrollbar inside kanban dark mode */
body.theme-dark .kanban-items::-webkit-scrollbar-thumb {
    background: #444;
}

/* 🌑 Modal dark mode */
body.theme-dark #completedTaskModal .bg-white {
    background-color: #1f242b !important;
    color: #e5e7eb;
}

body.theme-dark #completedTaskModal input[type="file"] {
    background-color: #171b21;
    color: #e5e7eb;
    border: 1px solid #444;
}

body.theme-dark #completedTaskModal button {
    border-color: #666;
}

body.theme-dark #completedTaskModal .text-white {
    background-color: #2d333b;
    color: #ffffff;
}

/* Optional: Slightly dim the background overlay if needed */
body.theme-dark #completedTaskModal {
    background-color: rgba(15, 18, 23, 0.85);
}








/*navbar collapse margin*/
    body.navbar-shrinked .lqd-navbar-inner {
        margin-left: -43px !important;
    }
/* Responsive styles for controls only - leaves table unchanged */
@media (max-width: 768px) {
    .controls .flex {
        flex-direction: column;
        gap: 1rem;
    }
    
    .left-controls, .right-controls {
        width: 100%;
    }
    
    .left-controls {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .bulk-actions select, .search {
        width: 100%;
    }
    
    .right-controls {
        display: flex;
        gap: 1rem;
    }
    
    .right-controls .btn-create {
        flex-grow: 1;
    }
    
    .filter-fields {
        padding: 1rem;
        background: #f5f5f5;
        border-radius: 8px;
        margin-top: 1rem;
    }
    
    .form-row-inline {
        flex-direction: column;
        gap: 1rem;
    }
    
    .form-group {
        width: 100%;
    }
    
    .filter-actions {
        flex-direction: column;
        gap: 0.5rem;
    }
}

@media (max-width: 480px) {
    .right-controls {
        flex-direction: column;
    }
    
    .btn-filter, .btn-create {
        width: 100%;
    }
    
    .filter-fields {
        padding: 0.5rem;
    }
    
    /* Only button styles in actions column */
    .actions {
        flex-wrap: wrap;
        gap: 0.5rem;
    }
    
    .action-btn {
        padding: 0.25rem 0.5rem;
        min-width: auto;
    }
}
    
     /* Responsive styles for controls only - leaves table unchanged */
    
    
    
    
    
    
    
    
    
    .fa-2xs {
  font-size: .825em;
  line-height: .1em;
  vertical-align: .225em;
}
.select2-selection, .select2-selection--multiple{
    display: flex;
    margin: 0px;
    padding: 0px;
}
.custom-c{
  /* background-color: #320580; */
      color:  #320580;
}
    .alert-message {
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 20px;
        border-radius: 4px;
        color: white;
        z-index: 9999;
        animation: fadeIn 0.5s, fadeOut 0.5s 4.5s;
        animation-fill-mode: forwards;
    }
    
    .alert-success {
        background-color: rgb(50, 5, 128);; /* Blue color */
    }
    
    .alert-error {
        background-color: #e3342f; /* Red color for errors */
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes fadeOut {
        from { opacity: 1; transform: translateY(0); }
        to { opacity: 0; transform: translateY(-20px); }
    }
    .select2-container--default .select2-selection--multiple {
            min-height: 38px;
            height: auto;
            padding: 6px;
        }
 .top{
    display: none;
    #dataTable tbody tr.even {
    background-color: #f9f9f9 !important; 
}
#dataTable tbody tr.odd {
    background-color: #ffffff !important; 
}
 }
 
 
 .fa-trash-can{
     margin-top: 11px;
 }
 
 
 
 /* Styles specifically for .lqd-btn-ghost-shadow */
.lqd-btn-ghost-shadow {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    font-size: 12px;
    font-weight: 500;
    border-radius: 9999px; /* fully rounded (pill or circle) */
    padding: 8px;
    background-color: #f9fafb; /* light background */
    color: #1C2A39;
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

/* Hover state */
.lqd-btn-ghost-shadow:hover {
    background-color: #6EE7B7;   /* mint background on hover */
    color: #1C2A39;
    box-shadow: 0 4px 12px rgba(110, 231, 183, 0.4);
    transform: translateY(-2px);
}

/* Focus state */
.lqd-btn-ghost-shadow:focus-visible {
    outline: 2px solid #6EE7B7;
    outline-offset: 2px;
}

/* Disabled state */
.lqd-btn-ghost-shadow:disabled,
.lqd-btn-ghost-shadow.disabled {
    opacity: 0.6;
    pointer-events: none;
}

/* Icon inside */
.lqd-btn-ghost-shadow svg,
.lqd-btn-ghost-shadow i {
    width: 16px;
    height: 16px;
    color: currentColor;
    fill: currentColor;
}

/* Light Mode (default) */
.lqd-btn-outline {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    font-size: 12px;
    font-weight: 500;
    border-radius: 9999px; /* full rounded */
    padding: 4px 10px;
    border: 1px solid #1C2A39; /* navy border */
    background-color: transparent;
    color: #1C2A39;
    transition: all 0.3s ease;
    cursor: pointer;
    text-decoration: none;
}

/* Dark Mode */
body.theme-dark .lqd-btn-outline {
    border-color: #4b5563; /* dark gray */
    color: #e5e7eb;        /* light text */
}

/* Hover State - Light */
.lqd-btn-outline:hover {
    background-color: #6EE7B7; /* mint bg */
    color: #1C2A39;
    border-color: #6EE7B7;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(110, 231, 183, 0.4);
}

/* Hover State - Dark */
body.theme-dark .lqd-btn-outline:hover {
    background-color: #4ade80; /* green-400 */
    color: #171B21;
    border-color: #4ade80;
    box-shadow: 0 4px 12px rgba(74, 222, 128, 0.4);
}

/* Disabled State */
.lqd-btn-outline:disabled,
.lqd-btn-outline.disabled {
    opacity: 0.6;
    pointer-events: none;
}

/* Icons inside */
.lqd-btn-outline i,
.lqd-btn-outline svg {
    width: 14px;
    height: 14px;
    color: currentColor;
    fill: currentColor;
}


 
 /* Apply styles only on buttons with type="submit" */
/*button[type="submit"],*/
.lqd-btn[type="submit"],
.x-button[type="submit"],
.action-btn[type="submit"],
.submit-btn[type="submit"],
.btn-filter[type="submit"],
.btn-create[type="submit"],
.btn-apply[type="submit"],
.btn-reset[type="submit"] {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;                      /* space between icon & text */
    font-size: 14px;
    font-weight: 500;
    border-radius: 6px;            /* rounded corners */
    padding: 8px 16px;
    border: 1px solid #1C2A39;    /* navy border */
    background-color: transparent;
    color: #1C2A39;               /* navy text */
    transition: all 0.3s ease;
    cursor: pointer;
}

/* Hover state for submit buttons */
button[type="submit"]:hover,
.lqd-btn[type="submit"]:hover,
.x-button[type="submit"]:hover,
.action-btn[type="submit"]:hover,
.submit-btn[type="submit"]:hover,
.btn-filter[type="submit"]:hover,
.btn-create[type="submit"]:hover,
.btn-apply[type="submit"]:hover,
.btn-reset[type="submit"]:hover {
    background-color: #6EE7B7;     /* mint background */
    color: #1C2A39;
    border-color: #6EE7B7;
    transform: translateY(-2px);   /* lift effect */
    box-shadow: 0 4px 12px rgba(110, 231, 183, 0.4);
}

/* Disabled state */
button[type="submit"]:disabled,
.lqd-btn[type="submit"]:disabled,
.x-button[type="submit"]:disabled,
.action-btn[type="submit"]:disabled,
.submit-btn[type="submit"]:disabled {
    opacity: 0.6;
    pointer-events: none;
}

/* Ensure icons inside scale properly */
button[type="submit"] i,
button[type="submit"] svg,
.lqd-btn[type="submit"] i,
.lqd-btn[type="submit"] svg,
.x-button[type="submit"] i,
.x-button[type="submit"] svg {
    width: 16px;
    height: 16px;
    color: currentColor;
    fill: currentColor;
}

 /* Submit button style */
.btn-container .submit-btn {
    background-color: #1C2A39;  /* navy background */
    color: #FFFFFF;             /* white text */
    border: 1px solid #1C2A39;  /* navy border */
    border-radius: 8px;         /* rounded */
    padding: 10px 20px;         /* comfortable size */
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
}

/* Hover state */
.btn-container .submit-btn:hover {
    background-color: #6EE7B7;  /* mint background */
    color: #1C2A39;             /* navy text */
    border-color: #6EE7B7;      /* mint border */
}



/* Base style for subscription buttons */
.max-xl\:hidden,
.max-xl\:hidden.x-button {
    background-color: transparent;
    color: #1C2A39; /* navy text for light */
    border: 1px solid #1C2A39;
    border-radius: 16px;
    padding: 8px 16px;
    font-size: 14px;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.3s ease;
    cursor: pointer;
}

/* Target buttons with href containing 'subscription' */
.max-xl\:hidden.x-button[href*="subscription"] {
    background-color: #1C2A39; /* navy background */
    color: #FFFFFF;            /* white text */
    border-color: #1C2A39;
}

/* Hover - Mint Green for both modes */
.max-xl\:hidden:hover,
.max-xl\:hidden.x-button:hover,
body.theme-dark .max-xl\:hidden:hover,
body.theme-dark .max-xl\:hidden.x-button:hover {
    background-color: #6EE7B7;  /* Mint green */
    color: #1C2A39;             /* Navy text */
    border-color: #6EE7B7;
}

/* SVG and icon color sync */
.max-xl\:hidden.x-button svg,
.max-xl\:hidden.x-button i,
body.theme-dark .max-xl\:hidden.x-button svg,
body.theme-dark .max-xl\:hidden.x-button i {
    fill: currentColor;
    color: currentColor;
}

/* Dark mode default (non-hover) style */
body.theme-dark .max-xl\:hidden,
body.theme-dark .max-xl\:hidden.x-button {
    background-color: transparent;
    color: #FFFFFF;             /* White text */
    border: 1px solid #FFFFFF;
}

/* Button specifically for subscription in dark mode */
body.theme-dark .max-xl\:hidden.x-button[href*="subscription"] {
    background-color: #1C2A39; /* same navy as light mode */
    color: #FFFFFF;
    border-color: #1C2A39;
}

 
 
.actions .action-btn {
    background-color: transparent;
    color: #1C2A39; 
    border: 1px solid #1C2A39; 
    border-radius: 17px;  
    padding: 6px 10px;    
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}


.actions .action-btn:hover {
    background-color: #6EE7B7;  
    color: #1C2A39;            
    border-color: #6EE7B7;     
}


.actions .action-btn i {
    font-size: 14px; 
}

 
 

/* Default Light Mode */
.right-controls .btn-filter,
.right-controls .btn-create,
.filter-actions .btn-apply,
.filter-actions .btn-reset,
.action-btn {
    background-color: transparent;
    color: #1C2A39;
    border: 1px solid #1C2A39;
    transition: all 0.3s ease;
    padding: 8px 16px;
    border-radius: 18px;
}

/* Dark Mode */
body.theme-dark .right-controls .btn-filter,
body.theme-dark .right-controls .btn-create,
body.theme-dark .filter-actions .btn-apply,
body.theme-dark .filter-actions .btn-reset,
body.theme-dark .action-btn {
    background-color: transparent;
    color: #e5e7eb; /* text-gray-200 */
    border: 1px solid #4b5563; /* dark gray border */
}

/* Optional hover effect */
.right-controls .btn-filter:hover,
.right-controls .btn-create:hover,
.filter-actions .btn-apply:hover,
.filter-actions .btn-reset:hover,
.action-btn:hover {
    background-color: #6EE7B7;
    color:  #1C2A39;
}

body.theme-dark .right-controls .btn-filter:hover,
body.theme-dark .right-controls .btn-create:hover,
body.theme-dark .filter-actions .btn-apply:hover,
body.theme-dark .filter-actions .btn-reset:hover,
body.theme-dark .action-btn:hover {
    background-color: #6EE7B7;
    color:  #1C2A39;
}


.lqd-titlebar-pretitle,
.lqd-titlebar-title,
.lqd-titlebar-subtitle {
    color: #1C2A39; 
}

.right-controls .btn-filter:hover,action-btn,
.right-controls .btn-create:hover,
.filter-actions .btn-apply:hover,
.filter-actions .btn-reset:hover {
    background-color: #6EE7B7; 
    color: #1C2A39;
    border-color: #6EE7B7;
}



/* Container holding titlebar actions */
.lqd-titlebar-actions {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 8px;                     /* small gap between buttons */
}

/* Buttons or links inside */
.lqd-titlebar-actions x-button,
.lqd-titlebar-actions .x-button,
.lqd-titlebar-actions button,
.lqd-titlebar-actions a {
    background-color: transparent;
    color: #1C2A39;               /* navy text 
    border: 1px solid #1C2A39;    /* navy border */
    border-radius: 17px;           /* slightly rounded */
    padding: 6px 14px;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;                     /* icon-text spacing */
    cursor: pointer;
}
/* 🌙 Dark Mode - Titlebar Button Styling */
body.theme-dark .lqd-titlebar-actions x-button,
body.theme-dark .lqd-titlebar-actions .x-button,
body.theme-dark .lqd-titlebar-actions button,
body.theme-dark .lqd-titlebar-actions a {
    background-color: transparent;
    color: #ffffff;
    border: 1px solid #ffffff;
    border-radius: 17px;
    padding: 6px 14px;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    cursor: pointer;
}

body.theme-dark .lqd-titlebar-actions a:hover,
body.theme-dark .lqd-titlebar-actions button:hover {
   background-color: #6EE7B7; 
    color: #1C2A39;
    border-color: #6EE7B7;
}

/* Hover effect */
.lqd-titlebar-actions x-button:hover,
.lqd-titlebar-actions .x-button:hover,
.lqd-titlebar-actions button:hover,
.lqd-titlebar-actions a:hover {
    background-color: #6EE7B7;    /* mint background */
    color: #1C2A39;               /* navy text */
    border-color: #6EE7B7;
}

/* Ensure any icons inside stay aligned */
.lqd-titlebar-actions i,
.lqd-titlebar-actions svg {
    color: currentColor;
    fill: currentColor;
    width: 16px;
    height: 16px;
}

</style>
<?php if(in_array($settings_two->chatbot_status, ['dashboard', 'both']) &&
        !activeRoute('dashboard.user.openai.chat.chat') &&
        !(route('dashboard.user.openai.generator.workbook', 'ai_vision') == url()->current()) &&
        !(route('dashboard.user.openai.generator.workbook', 'ai_chat_image') == url()->current()) &&
        !(route('dashboard.user.openai.generator.workbook', 'ai_pdf') == url()->current())): ?>
    <?php if(
        !Route::has('dashboard.user.openai.webchat.workbook') ||
            (Route::has('dashboard.user.openai.webchat.workbook') && route('dashboard.user.openai.webchat.workbook') !== url()->current())): ?>
        <script src="<?php echo e(custom_theme_url('/assets/js/panel/openai_chatbot.js')); ?>"></script>
    <?php endif; ?>
<?php endif; ?>

<script>
    var magicai_localize = {
        <?php $__currentLoopData = json_decode(file_get_contents(base_path('lang/en.json')), true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $safeKey = preg_replace('/[^a-zA-Z0-9_]/', '_', strtolower($key));
                if (is_numeric(substr($safeKey, 0, 1))) {
                    $safeKey = '_' . $safeKey;
                }
            ?>
            <?php echo e($safeKey); ?>: <?php echo json_encode($value, 15, 512) ?>,
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    };
    var magicai_localize_second_part = {
        signup: <?php echo json_encode(__('Sign Up'), 15, 512) ?>,
        please_wait: <?php echo json_encode(__('Please Wait...'), 15, 512) ?>,
        sign_in: <?php echo json_encode(__('Sign In'), 15, 512) ?>,
        login_redirect: <?php echo json_encode(__('Login Successful, Redirecting...'), 512) ?>,
        register_redirect: <?php echo json_encode(__('Registration is complete. Redirecting...'), 15, 512) ?>,
        password_reset_link: <?php echo json_encode(__('Password reset link sent succesfully. Please also check your spam folder.'), 15, 512) ?>,
        password_reset_done: <?php echo json_encode(__('Password succesfully changed.'), 15, 512) ?>,
        password_reset: <?php echo json_encode(__('Reset Password'), 15, 512) ?>,
        missing_email: <?php echo json_encode(__('Please enter your email address.'), 15, 512) ?>,
        missing_password: <?php echo json_encode(__('Please enter your password.'), 15, 512) ?>,
        content_copied_to_clipboard: <?php echo json_encode(__('Content copied to clipboard.'), 15, 512) ?>,
        text_content_copied_to_clipboard: <?php echo json_encode(__('Plain text content copied to clipboard.'), 15, 512) ?>,
        md_content_copied_to_clipboard: <?php echo json_encode(__('Markdown content copied to clipboard.'), 15, 512) ?>,
        html_content_copied_to_clipboard: <?php echo json_encode(__('HTML content copied to clipboard.'), 15, 512) ?>,
        new_chat_conversation_successfully: <?php echo json_encode(__('New conversation created successfully.'), 15, 512) ?>,
        conversation_deleted_successfully: <?php echo json_encode(__('Conversation deleted successfully.'), 15, 512) ?>,
        analyze_file_begin: <?php echo json_encode(__('Analyzing uploaded file.'), 15, 512) ?>,
        analyze_file_finish: <?php echo json_encode(__('Analyzing file is done. You can start the conversation.'), 15, 512) ?>,
        please_active_magicai: <?php echo json_encode(__('Please Active The MagicAI'), 15, 512) ?>,
        please_enter_url: <?php echo json_encode(__('Please enter the URL'), 15, 512) ?>,
        you_cannot_withdrawal: <?php echo json_encode(__('You cannot withdrawal with this amount. Please check'), 15, 512) ?>,
        error_while_sending: <?php echo json_encode(__('Error while sending information. Please contact us.'), 15, 512) ?>,
        please_fill_message: <?php echo json_encode(__('Please fill the message field'), 15, 512) ?>,
        api_connection_error: <?php echo json_encode(__('Api Connection Error. You hit the rate limites of openai requests. Please check your Openai API Key'), 15, 512) ?>,
        api_connection_error_admin: <?php echo json_encode(__('Api Connection Error. Please contact system administrator via Support Ticket. Error is: API Connection failed due to API keys'), 15, 512) ?>,
        file_size_exceed: <?php echo json_encode(__('This file exceed the limit of file upload'), 15, 512) ?>,
        something_wrong: <?php echo json_encode(__('Something went wrong. Please reload the page and try it again'), 15, 512) ?>,
        fill_all_fields: <?php echo json_encode(__('Please fill all fields in User Group Input areas'), 15, 512) ?>,
        workbook_error: <?php echo json_encode(__('Workbook Error'), 15, 512) ?>,
        settings_saved: <?php echo json_encode(__('Settings saved successfully. Redirecting...'), 15, 512) ?>,
        request_sent: <?php echo json_encode(__('Request Sent Succesfully'), 15, 512) ?>,
        invitation_sent: <?php echo json_encode(__('Invitation Sent Succesfully!'), 15, 512) ?>,
        page_saved: <?php echo json_encode(__('Page Saved Succesfully'), 15, 512) ?>,
        template_saved: <?php echo json_encode(__('Template Saved Succesfully'), 15, 512) ?>,
        saved: <?php echo json_encode(__('Saved Succesfully'), 15, 512) ?>,
        client_saved: <?php echo json_encode(__('Client Saved Succesfully. Redirecting...'), 15, 512) ?>,
        plan_saved: <?php echo json_encode(__('Plan Saved Succesfully. Redirecting...'), 15, 512) ?>,
        how_it_works_step_saved: <?php echo json_encode(__('How it Works Step Saved Succesfully. Redirecting...'), 15, 512) ?>,
        how_it_works_bottom_line_saved: <?php echo json_encode(__('How it Works Bottom Line updated successfully. Redirecting...'), 15, 512) ?>,
        addon_installed: <?php echo json_encode(__('Add-on installed succesfully.'), 15, 512) ?>,
        addon_uninstalled: <?php echo json_encode(__('Add-on uninstalled succesfully.'), 15, 512) ?>,
        status_changed: <?php echo json_encode(__('Status changed succesfully'), 15, 512) ?>,
        chat_template_saved: <?php echo json_encode(__('Chat Template Saved Succesfully'), 15, 512) ?>,
        settings_saved: <?php echo json_encode(__('Settings saved succesfully'), 15, 512) ?>,
        settings_saved_redirecting: <?php echo json_encode(__('Settings saved succesfully. Redirecting...'), 15, 512) ?>,
        faq_saved: <?php echo json_encode(__('Faq saved succesfully. Redirecting'), 15, 512) ?>,
        item_saved: <?php echo json_encode(__('Item saved succesfully. Redirecting'), 15, 512) ?>,
        support_ticket_created: <?php echo json_encode(__('Support Ticket Created Succesfully. Redirecting...'), 15, 512) ?>,
        message_sent: <?php echo json_encode(__('Message sent succesfully. Please Wait'), 15, 512) ?>,
        testimonial_saved: <?php echo json_encode(__('Testimonial Saved Succesfully. Redirecting...'), 15, 512) ?>,
        user_saved: <?php echo json_encode(__('User saved succesfully'), 15, 512) ?>,
        workbook_saved: <?php echo json_encode(__('Workbook saved succesfully'), 15, 512) ?>,
        code_copied: <?php echo json_encode(__('Code copied to clipboard'), 15, 512) ?>,
        content_copied: <?php echo json_encode(__('Content copied to clipboard'), 15, 512) ?>,
        search: <?php echo json_encode(__('Search...'), 15, 512) ?>,
        what_would_you_like_to_do: <?php echo json_encode(__('What would you like to do?'), 15, 512) ?>,
        rewrite: <?php echo json_encode(__('Rewrite'), 15, 512) ?>,
        summarize: <?php echo json_encode(__('Summarize'), 15, 512) ?>,
        make_it_longer: <?php echo json_encode(__('Make it Longer'), 15, 512) ?>,
        make_it_shorter: <?php echo json_encode(__('Make it Shorter'), 15, 512) ?>,
        improve_writing: <?php echo json_encode(__('Improve Writing'), 15, 512) ?>,
        translate_to: <?php echo json_encode(__('Translate to'), 15, 512) ?>,
        search: <?php echo json_encode(__('Search'), 15, 512) ?>,
        simplify: <?php echo json_encode(__('Simplify'), 15, 512) ?>,
        change_style_to: <?php echo json_encode(__('Change Style to'), 15, 512) ?>,
        change_tone_to: <?php echo json_encode(__('Change Tone to'), 15, 512) ?>,
        fix_grammatical_mistakes: <?php echo json_encode(__('Fix Grammatical Mistakes'), 15, 512) ?>,
    }
    Object.assign(magicai_localize, magicai_localize_second_part);
    $('#dataTable').on('processing.dt', function (e, settings, processing) {
        if (processing) {
            $('#dataTable_processing').css('top', '100px');
            // $('#dataTable_processing').css('background','transparent');
        }
    });
</script>
<?php echo $__env->yieldContent('additional_scripts'); ?>
<script>
      $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select one or more",
                closeOnSelect: false
            });
            
            // Adjust height when window is resized
            $(window).on('resize', function() {
                $('.select2').select2('close');
            });
        });
</script>

<script>
    toastr.options = {
        positionClass: 'toast-top-custom',
        timeOut: 3000,
        // closeButton: true,
        // progressBar: true,
    };
</script>
<!-- Alpine.js App Store Definitions -->
<script src="<?php echo e(custom_theme_url('/assets/js/bootstrap.js')); ?>"></script>
<script src="<?php echo e(custom_theme_url('/assets/js/app.js')); ?>"></script>
<!-- Alpine.js -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<!--<script>-->
<!--    $(document).ready(function () {-->
<!--        $('[id^=fav-btn-]').on('click', function (e) {-->
<!--            e.preventDefault();-->
<!--console.log("in");-->
<!--            const $btn = $(this);-->
<!--            const id = $btn.data('id');-->
<!--            const url = $btn.data('url');-->
<!--            const token = '<?php echo e(csrf_token()); ?>';-->

<!--            $.ajax({-->
<!--                url: url,-->
<!--                type: 'get',-->
<!--                data: {-->
<!--                    _token: token,-->
<!--                    id: id,-->
<!--                },-->
<!--                success: function () {-->
<!--                    const isActive = $btn.hasClass('bg-green-500');-->

<!--                    if (isActive) {-->
<!--                        $btn.removeClass('bg-green-500 text-white').addClass('bg-white text-black');-->
<!--                        toastr.success('Removed from favorites');-->
<!--                    } else {-->
<!--                        $btn.removeClass('bg-white text-black').addClass('bg-green-500 text-white');-->
<!--                        toastr.success('Added to favorites');-->
<!--                    }-->
<!--                },-->
<!--                error: function () {-->
<!--                    toastr.error('Something went wrong.');-->
<!--                }-->
<!--            });-->
<!--        });-->
<!--    });-->
<!--</script>-->

<?php if(session('message') || session('success') || session('error')): ?>
<div id="tailwind-alerts" class="fixed top-4 right-2 z-50 w-1/3 space-y-2"></div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if(session('message') && session('type')): ?>
            showAlert('<?php echo e(session("type")); ?>', '<?php echo e(session("message")); ?>');
        <?php elseif(session('success')): ?>
            showAlert('success', '<?php echo e(session("success")); ?>');
        <?php elseif(session('error')): ?>
            showAlert('error', '<?php echo e(session("error")); ?>');
        <?php endif; ?>
    });

    function showAlert(type, message) {
        const container = document.getElementById('tailwind-alerts');
        const alert = document.createElement('div');
       
        // Base classes - reduced padding and tighter layout
        let alertClasses = 'px-3 py-2 rounded-md shadow-sm flex items-start animate__animated animate__fadeInRight animate__faster ';
        let iconPath = '';
       
        // Type-specific styling
        switch(type) {
            case 'success':
                alertClasses += ' bg-green-500 text-white border border-green-200';
                iconPath = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>';
                break;
            case 'error':
                alertClasses += ' bg-red-500 text-white border border-red-200';
                iconPath = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
                break;
            case 'warning':
                alertClasses += ' bg-yellow-500 text-white border border-yellow-200';
                iconPath = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>';
                break;
            default: // info
                alertClasses += ' bg-blue-100 text-blue-800 border border-blue-200';
                iconPath = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>';
        }

        alert.className = alertClasses;
        alert.innerHTML = `
            <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                ${iconPath}
            </svg>
            <div class="flex-1">
                <p class="text-sm font-medium capitalize">${type}!<br>${message}</p>
            </div>
            <button class="ml-1 p-0.5 rounded-full hover:bg-black/10 transition-colors" onclick="this.parentElement.remove()">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        `;

        container.appendChild(alert);
       
        // Auto-remove after 5 seconds
        setTimeout(() => {
            alert.classList.replace('animate__fadeInRight', 'animate__fadeOutRight');
            setTimeout(() => alert.remove(), 300);
        }, 5000);
    }
</script>
<?php endif; ?>
<script>
    // Auto-remove messages after 5 seconds
    // document.addEventListener('DOMContentLoaded', function() {
    //     setTimeout(function() {
    //         const messages = document.querySelectorAll('.alert-message');
    //         messages.forEach(function(message) {
    //             message.remove();
    //         });
    //     }, 5000);
    // });
</script>
<!-- PAGES JS-->
<?php if(auth()->guard()->guest()): ?>
    <script src="<?php echo e(custom_theme_url('/assets/js/panel/login_register.js')); ?>"></script>
<?php endif; ?>

<?php if(auth()->guard()->check()): ?>
    <script src="<?php echo e(custom_theme_url('/assets/js/tabler.min.js')); ?>"></script>
    <script src="<?php echo e(custom_theme_url('/assets/js/panel/search.js')); ?>"></script>
    <script src="<?php echo e(custom_theme_url('/assets/libs/list.js/dist/list.js')); ?>"></script>
<?php endif; ?>
<?php /**PATH /var/www/Novuk/resources/views/default/panel/layout/scripts.blade.php ENDPATH**/ ?>