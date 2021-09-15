
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;

        class CreateWatchesTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("watches", function (Blueprint $table) {

						$table->bigIncrements('id');
						$table->string('watch');
						$table->bigInteger('users_id')->unsigned();
						$table->timestamps();


                    //*********************************
                    // Foreign KEY [ Uncomment if you want to use!! ]
                    //*********************************
                        //$table->foreign("users_id")->references("id")->on("users");



						// ----------------------------------------------------
						// -- SELECT [watchs]--
						// ----------------------------------------------------
						// $query = DB::table("watchs")
						// ->leftJoin("users","users.id", "=", "watchs.users_id")
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
                Schema::dropIfExists("watches");
            }
        }
