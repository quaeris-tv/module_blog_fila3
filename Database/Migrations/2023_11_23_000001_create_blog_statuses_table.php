<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Blog\Models\Status;
use Modules\Xot\Database\Migrations\XotBaseMigration;

/*
 * Class CreateBlogStatusesTable.
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
    protected ?string $model_class = Status::class;

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // -- CREATE --
        $this->tableCreate(
            static function (Blueprint $table): void {
                $table->id();
                $table->string('name');
                $table->text('reason')->nullable();
                $table->morphs('model');
                $table->timestamps();
            }
        );
        // -- UPDATE --
        $this->tableUpdate(
            function (Blueprint $table): void {
                if (! $this->hasColumn('name')) {
                    $table->string('name');
                }
                if (! $this->hasColumn('reason')) {
                    $table->string('reason')->nullable();
                }
                if (! $this->hasColumn('model_id')) {
                    $table->morphs('model');
                }

                $this->updateTimestamps(table: $table, hasSoftDeletes: true);
            }
        );
    }
};
