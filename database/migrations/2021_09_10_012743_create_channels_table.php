
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;

        class CreateChannelsTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("channels", function (Blueprint $table) {

						$table->bigIncrements('id');
						$table->string('channel');
						$table->bigInteger('users_id')->unsigned();
						$table->timestamps();
						//$table->foreign("users_id")->references("id")->on("users");



						// ----------------------------------------------------
						// -- SELECT [channels]--
						// ----------------------------------------------------
						// $query = DB::table("channels")
						// ->leftJoin("users","users.id", "=", "channels.users_id")
						// ->get();
						// dd($query); //For checking



                });
            }

            /**
             * Reverse the migrations.
             *
             * @return void
             */
            public function down()
            {
                Schema::dropIfExists("channels");
            }
        }
