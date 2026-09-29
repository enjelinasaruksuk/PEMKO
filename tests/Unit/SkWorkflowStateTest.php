<?php

namespace Tests\Unit;

use App\Models\Sk;
use PHPUnit\Framework\TestCase;

class SkWorkflowStateTest extends TestCase
{
    public function test_only_drafts_and_returned_sk_can_be_edited_by_the_owner(): void
    {
        foreach ([Sk::REVIEW_DRAFT, Sk::REVIEW_NEEDS_CHANGES] as $editableStatus) {
            $sk = new Sk(['review_status' => $editableStatus]);

            $this->assertTrue($sk->isEditableByOwner());
        }

        foreach ([Sk::REVIEW_PENDING_ADMIN, Sk::REVIEW_PENDING_INSTANSI, Sk::REVIEW_APPROVED] as $lockedStatus) {
            $sk = new Sk(['review_status' => $lockedStatus]);

            $this->assertFalse($sk->isEditableByOwner());
        }
    }
}
