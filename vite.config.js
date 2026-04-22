import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/css/index.css",
                "resources/css/frontend/home.css",
                "resources/css/frontend/games/catalog.css",
                "resources/css/frontend/games/show.css",
                "resources/css/frontend/account/account.css",
                "resources/css/auth/login.css",
                "resources/css/auth/signup.css",
                "resources/css/auth/reset_password.css",
                "resources/css/auth/verify_code.css",
                "resources/css/auth/new_password.css",
                "resources/css/backend/games/index.css",
                "resources/css/backend/games/create.css",
                "resources/css/backend/games/edit.css",
                "resources/css/backend/users/index.css",
                "resources/css/backend/users/create.css",
                "resources/css/backend/users/edit.css",
                "resources/css/components/header.css",
                "resources/css/components/header_adm.css",
                "resources/css/components/footer.css",
            ],
            refresh: true,
        }),
    ],
});
