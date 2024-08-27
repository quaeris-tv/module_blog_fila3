<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Xot\Database\Migrations\XotBaseMigration;
use Modules\Xot\Datas\XotData;

<<<<<<< HEAD
<<<<<<< HEAD
return new class extends XotBaseMigration {
=======
return new class() extends XotBaseMigration {
>>>>>>> 7be4a6be39f053c0a5a14e0d1e692343220eb6a6
=======
return new class extends XotBaseMigration {
>>>>>>> fe872a23dd2cb35bf304d5ce734c44a14645de4b
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $this->tableCreate(
            static function (Blueprint $table): void {
                $table->id();
                $table->nullableMorphs('model');
                $table->integer('credits')->nullable();
<<<<<<< HEAD
                $table->foreignIdFor(Modules\Xot\Datas\XotData::make()->getUserClass(), 'user_id')->nullable();
=======
                $table->foreignIdFor(XotData::make()->getUserClass(), 'user_id')->nullable();
>>>>>>> fe872a23dd2cb35bf304d5ce734c44a14645de4b
                $table->text('note')->nullable();
                $table->datetimetz('date')->nullable();
            }
        );

        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table): void {
                // if (! $this->hasColumn('rating_id')) {
                //     $table->integer('rating_id')->after('article_id');
                // }

                // $table->char('description')->change();

                if ($this->hasColumn('credits')) {
                    $table->decimal('credits')->change();
                }

                $this->updateTimestamps(table: $table, hasSoftDeletes: true);
            }
        );
    }
};
