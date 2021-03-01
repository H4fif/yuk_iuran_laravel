<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnPhotoPhoneNumberDateOfBirthAreaIdAddressToTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('photo');
            $table->string('phone_number');
            $table->date('date_of_birth');
            $table->string('address');
            $table->integer('area_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('uses', function (Blueprint $table) {
            $table->dropColumn(['photo', 'phone_number', 'date_of_birth', 'address', 'area_id']);
        });
    }
}
