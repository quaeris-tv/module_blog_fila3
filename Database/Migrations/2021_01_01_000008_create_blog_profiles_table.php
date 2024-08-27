<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Blog\Models\Profile;
use Modules\Xot\Database\Migrations\XotBaseMigration;

/*
 * Class CreateProfilesTable.
 */
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
return new class extends XotBaseMigration {
=======
return new class() extends XotBaseMigration {
>>>>>>> 7be4a6be39f053c0a5a14e0d1e692343220eb6a6
=======
return new class extends XotBaseMigration {
>>>>>>> fe872a23dd2cb35bf304d5ce734c44a14645de4b
=======
return new class extends XotBaseMigration {
>>>>>>> 949b76732b8df9e823421a787ac0d1cf686214e1
    protected ?string $model_class = Profile::class;

    /**
     * db up.
     */
    public function up(): void
    {
        // -- CREATE --
        $this->tableCreate(
            static function (Blueprint $table): void {
                $table->increments('id');
                $table->integer('user_id')->nullable()->index();
                $table->string('first_name')->nullable();
                $table->string('last_name')->nullable();
                $table->string('email')->nullable();
            }
        );
        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table): void {
                /*
                if ($this->hasColumn('auth_user_id')) {
                    $table->dropColumn('user_id');
                    $table->renameColumn('auth_user_id', 'user_id');
                }
                */
                if ($this->hasColumn('user_id')) {
                    $table->string('user_id')->change();
                }

                if (! $this->hasColumn('credits')) {
                    $table->decimal('credits');
                }

                if (! $this->hasColumn('slug')) {
                    $table->string('slug')->nullable();
                }

                if (! $this->hasColumn('extra')) {
                    $table->schemalessAttributes('extra');
                }

                if ($this->hasColumn('credits')) {
                    $table->decimal('credits')->change();
                }
                $this->updateTimestamps(table: $table, hasSoftDeletes: true);
            }
        );
    }
};
