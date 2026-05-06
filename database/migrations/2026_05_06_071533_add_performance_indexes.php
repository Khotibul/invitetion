<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Tambahkan index pada kolom yang sering diquery
 * untuk meningkatkan performa database.
 */
return new class extends Migration
{
    public function up(): void
    {
        // invitations — sering dicari by slug dan user_id
        if (Schema::hasTable('invitations')) {
            Schema::table('invitations', function (Blueprint $table) {
                if (!$this->indexExists('invitations', 'invitations_slug_index')) {
                    $table->index('slug', 'invitations_slug_index');
                }
                if (!$this->indexExists('invitations', 'invitations_publish_index')) {
                    $table->index('publish', 'invitations_publish_index');
                }
            });
        }

        // account_invoices — sering dicari by user_id + status
        if (Schema::hasTable('account_invoices')) {
            Schema::table('account_invoices', function (Blueprint $table) {
                if (!$this->indexExists('account_invoices', 'invoices_user_status_index')) {
                    $table->index(['user_id', 'status'], 'invoices_user_status_index');
                }
                if (!$this->indexExists('account_invoices', 'invoices_status_index')) {
                    $table->index('status', 'invoices_status_index');
                }
            });
        }

        // templates — sering dicari by publish + grade
        if (Schema::hasTable('templates')) {
            Schema::table('templates', function (Blueprint $table) {
                if (!$this->indexExists('templates', 'templates_publish_grade_index')) {
                    $table->index(['publish', 'grade'], 'templates_publish_grade_index');
                }
                if (!$this->indexExists('templates', 'templates_slug_index')) {
                    $table->index('slug', 'templates_slug_index');
                }
            });
        }

        // invitation_guests — sering dicari by slug + invitation_id
        if (Schema::hasTable('invitation_guests')) {
            Schema::table('invitation_guests', function (Blueprint $table) {
                if (!$this->indexExists('invitation_guests', 'guests_slug_inv_index')) {
                    $table->index(['slug', 'invitation_id'], 'guests_slug_inv_index');
                }
            });
        }

        // invitation_events — sering dicari by invitation_id
        if (Schema::hasTable('invitation_events')) {
            Schema::table('invitation_events', function (Blueprint $table) {
                if (!$this->indexExists('invitation_events', 'events_invitation_index')) {
                    $table->index('invitation_id', 'events_invitation_index');
                }
            });
        }

        // invitation_stories — sering dicari by invitation_id
        if (Schema::hasTable('invitation_stories')) {
            Schema::table('invitation_stories', function (Blueprint $table) {
                if (!$this->indexExists('invitation_stories', 'stories_invitation_index')) {
                    $table->index('invitation_id', 'stories_invitation_index');
                }
            });
        }

        // invitation_galleries — sering dicari by invitation_id + type
        if (Schema::hasTable('invitation_galleries')) {
            Schema::table('invitation_galleries', function (Blueprint $table) {
                if (!$this->indexExists('invitation_galleries', 'galleries_inv_type_index')) {
                    $table->index(['invitation_id', 'type'], 'galleries_inv_type_index');
                }
            });
        }

        // strboxes — sering dicari by user_id + file_type
        if (Schema::hasTable('strboxes')) {
            Schema::table('strboxes', function (Blueprint $table) {
                if (!$this->indexExists('strboxes', 'strboxes_user_type_index')) {
                    $table->index(['user_id', 'file_type'], 'strboxes_user_type_index');
                }
            });
        }

        // feedbacks — sering dicari by invitation_id + type
        if (Schema::hasTable('feedbacks')) {
            Schema::table('feedbacks', function (Blueprint $table) {
                if (!$this->indexExists('feedbacks', 'feedbacks_inv_type_index')) {
                    $table->index(['invitation_id', 'type'], 'feedbacks_inv_type_index');
                }
            });
        }
    }

    public function down(): void
    {
        $drops = [
            'invitations'         => ['invitations_slug_index', 'invitations_publish_index'],
            'account_invoices'    => ['invoices_user_status_index', 'invoices_status_index'],
            'templates'           => ['templates_publish_grade_index', 'templates_slug_index'],
            'invitation_guests'   => ['guests_slug_inv_index'],
            'invitation_events'   => ['events_invitation_index'],
            'invitation_stories'  => ['stories_invitation_index'],
            'invitation_galleries'=> ['galleries_inv_type_index'],
            'strboxes'            => ['strboxes_user_type_index'],
            'feedbacks'           => ['feedbacks_inv_type_index'],
        ];

        foreach ($drops as $table => $indexes) {
            if (Schema::hasTable($table)) {
                Schema::table($table, function (Blueprint $t) use ($indexes) {
                    foreach ($indexes as $idx) {
                        try { $t->dropIndex($idx); } catch (\Exception $e) {}
                    }
                });
            }
        }
    }

    private function indexExists(string $table, string $indexName): bool
    {
        try {
            $indexes = \Illuminate\Support\Facades\DB::select(
                "SELECT indexname FROM pg_indexes WHERE tablename = ? AND indexname = ?",
                [$table, $indexName]
            );
            return count($indexes) > 0;
        } catch (\Exception $e) {
            return false;
        }
    }
};
