<?php

namespace App\Contracts;

interface ModeQuery
{
    const MODEL_SINGLE = 'single';
    const MODEL_COLLECTION = 'collection';

    const GROUP_BY_CATEGORY = 'category';
    const GROUP_BY_TAG = 'tag';
}
