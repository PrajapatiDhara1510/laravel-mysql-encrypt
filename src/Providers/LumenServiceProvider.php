<?php

namespace PrajapatiDhara1510\MysqlEncrypt\Providers;

use Illuminate\Support\ServiceProvider;
use PrajapatiDhara1510\MysqlEncrypt\Traits\ValidatesEncrypted;

class LumenServiceProvider extends ServiceProvider
{
    use ValidatesEncrypted;

    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        $this->app->configure('mysql-encrypt');

        $path = realpath(__DIR__ . '/../../config/config.php');

        $this->mergeConfigFrom($path, 'mysql-encrypt');

        $this->addValidators();
    }
}
