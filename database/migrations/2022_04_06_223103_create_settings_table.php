<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('value');
            $table->string('default')->nullable();
            $table->timestamps();
        });

        DB::table('settings')->insert(
            array(
                'key' => 'primary-color',
                'value' => '#5b21b6',
                'default' => '#5b21b6'
            )
        );
        DB::table('settings')->insert(
            array(
                'key' => 'secondary-color',
                'value' => '#374151',
                'default' => '#374151'
            )
        );
        DB::table('settings')->insert(
            array(
                'key' => 'accent-color',
                'value' => '#dc2626',
                'default' => '#dc2626'
            )
        );
        DB::table('settings')->insert(
            array(
                'key' => 'footer-text',
                'value' => 'NOUS VOUS OFFRONS LA MEILLEURE QUALITÉ AU MEILLEUR PRIX!',
                'default' => 'NOUS VOUS OFFRONS LA MEILLEURE QUALITÉ AU MEILLEUR PRIX!'
            )
        );
        DB::table('settings')->insert(
            array(
                'key' => 'logo-type',
                'value' => 'text',
                'default' => 'text'
            )
        );
        DB::table('settings')->insert(
            array(
                'key' => 'logo-text',
                'value' => 'PanierMedia',
                'default' => 'PanierMedia'
            )
        );
        DB::table('settings')->insert(
            array(
                'key' => 'logo-image-url',
                'value' => '/images/logo.png',
                'default' => '/images/logo.png'
            )
        );
        DB::table('settings')->insert(
            array(
                'key' => 'default-news-slider',
                'value' => 'true',
                'default' => 'true'
            )
        );
        DB::table('settings')->insert(
            array(
                'key' => 'show-all-categories',
                'value' => 'false',
                'default' => 'false'
            )
        );
        DB::table('settings')->insert(
            array(
                'key' => 'phone',
                'value' => '0670-133676',
                'default' => ''
            )
        );
        DB::table('settings')->insert(
            array(
                'key' => 'address',
                'value' => 'Drissia 1 Rue 14 N°4 - Tanger-Médina',
                'default' => ''
            )
        );
        DB::table('settings')->insert(
            array(
                'key' => 'products-per-page',
                'value' => '20',
                'default' => '20'
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
