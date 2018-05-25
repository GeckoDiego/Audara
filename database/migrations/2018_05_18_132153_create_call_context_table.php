<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/** 
 * @note Create the call_contextuser table
 * @note the structure is linked to the Call_context model (app/Call_context.php)
 * @date 18-05-2018
 * @author José Torres 
 * @copyright Gecko sas
 * @package CreateCallContextTable
 * @version Audara 1.0
 * 
*/

class CreateCallContextTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * @note Create the call_context table
     */
    public function up()
    {
        Schema::create('call_context', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',60);
            $table->text('description');

            $table->enum('status', array('ENABLED', 'DISABLED'))->default('ENABLED'); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     * @note Remove the call_context table
     */
    public function down()
    {
        Schema::dropIfExists('call_context');
    }
}
