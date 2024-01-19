<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Blog\Models\Profile;
use Modules\Xot\Database\Migrations\XotBaseMigration;

/**
 * Class CreateProfilesTable.
 */
class CreateBlogProfilesTable extends XotBaseMigration
{
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
<<<<<<< HEAD
                if (! $this->hasColumn('credits')) {
=======
                if (!$this->hasColumn('credits')) {
>>>>>>> 0f9a9ba (test)
                    $table->float('credits');
                }
                $this->updateTimestamps(table: $table, hasSoftDeletes: true);
            }
        );
    }
}
