<?php

namespace App\Contracts;

interface ModeQuery
{
    const MODEL_SINGLE = 'single';
    const MODEL_COLLECTION = 'collection';

    const MODEL_USER_PARENT = 'parent';
    const MODEL_USER_TEACHER = 'teacher';
    const MODEL_USER_STUDENT = 'student';

    const GROUP_BY_CATEGORY = 'category';
    const GROUP_BY_TAG = 'tag';
}
