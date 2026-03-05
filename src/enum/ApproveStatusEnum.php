<?php

namespace app\enum;

enum ApproveStatusEnum: string
{
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case DECLINED = 'declined';
}
