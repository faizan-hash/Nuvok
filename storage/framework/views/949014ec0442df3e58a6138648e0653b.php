<script>
    (() => {
        const lqdDarkMode = localStorage.getItem("lqdDarkMode");
        const navbarIsShrinked = localStorage.getItem("lqdNavbarShrinked");

        document.body.classList.toggle("theme-dark", lqdDarkMode == "true");
        document.body.classList.toggle("theme-light", lqdDarkMode != "true");

        if (navbarIsShrinked === "true") {
            document.body.classList.add("navbar-shrinked");
        }
    })();
</script>

<?php if(auth()->guard()->check()): ?>
    <script>
        (() => {
            const currentTheme = document.querySelector('body').getAttribute('data-theme');
            const focusModeEnabled = localStorage.getItem(currentTheme + ":lqdFocusModeEnabled");

            document.body.classList.toggle("focus-mode", focusModeEnabled == "true");
        })
        ();
    </script>
<?php endif; ?>
<?php /**PATH /home/u832531023/domains/nuvokai.com/public_html/resources/views/default/panel/layout/partials/mode-script.blade.php ENDPATH**/ ?>