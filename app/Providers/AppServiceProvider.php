<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // Adiciona coluna status na tabela orders se ainda não existir
        // (evita migration — coluna é adicionada uma única vez no boot)
        if (Schema::hasTable('orders') && !Schema::hasColumn('orders', 'status')) {
            DB::statement("
                ALTER TABLE orders
                ADD COLUMN status ENUM('in_progress','completed','refused')
                NOT NULL DEFAULT 'in_progress'
            ");
        }
    }
}