<?php

namespace App\Console\Commands;

use App\Models\Members;
use Illuminate\Console\Command;

class UpdateMemberCodes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-member-codes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $members = Members::all();

        foreach ($members as $member) {
            $member->updateCode();
        }

        $this->info('Member codes have been updated successfully.');
    }
}
