<?php

declare(strict_types=1);

use Illuminate\Database\Schema\Blueprint;
use Modules\Blog\Models\Page;
use Modules\Xot\Database\Migrations\XotBaseMigration;

/**
 * Class CreateProfilesTable.
 */
class CreateBlogPagesTable extends XotBaseMigration
{
    protected ?string $model_class = Page::class;

    /**
     * db up.
     */
    public function up(): void
    {
        // -- CREATE --
        $this->tableCreate(
            static function (Blueprint $table): void {
                $table->id();
                $table->timestamps();
                $table->string('slug')->unique();
                $table->string('title');
                $table->text('content');
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
                if (! $this->hasColumn('content_blocks')) {
                    $table->text('content_blocks')->nullable();
                }

                if (! $this->hasColumn('sidebar_blocks')) {
                    $table->text('sidebar_blocks')->nullable();
                }

                $this->updateTimestamps(table: $table, hasSoftDeletes: true);
            }
        );
    }
}
