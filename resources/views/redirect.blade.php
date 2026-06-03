<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Redirecting...') }}</title>
</head>
<body>
    <script>
        // Function to get locale from localStorage or browser
        function getLocale() {
            let locale = localStorage.getItem('locale');
            if (!locale) {
                const lang = navigator.language || navigator.userLanguage;
                locale = lang.startsWith('pt') ? 'pt' : 'en';
                localStorage.setItem('locale', locale);
            }
            return locale;
        }

        // Redirect to the appropriate locale
        const locale = getLocale();
        window.location.href = '/' + locale + '/';
    </script>
</body>
</html>
