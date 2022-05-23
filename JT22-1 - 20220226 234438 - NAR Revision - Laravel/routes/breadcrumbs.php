<?php

Breadcrumbs::for('allocation', function ($trail) {
    $trail->push('Allocation', route('allocation'));
});

Breadcrumbs::for('classroom', function ($trail) {
    $trail->push('Classroom', route('classroom'));
});

Breadcrumbs::for('lecturer', function ($trail) {
    $trail->push('Lecturer', route('lecturer'));
});

Breadcrumbs::for('student', function ($trail) {
    $trail->push('Student', route('student'));
});

Breadcrumbs::for('subject', function ($trail) {
    $trail->push('Subject', route('subject'));
});


Breadcrumbs::for('courses', function ($trail) {
    $trail->push('Course', route('courses'));
});

Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', route('dashboard'));
});
Breadcrumbs::for('forums', function ($trail) {
    $trail->push('Forum', route('forums'));
});
Breadcrumbs::for('schedules', function ($trail) {
    $trail->push('Schedule', route('schedules'));
});

Breadcrumbs::for('forumDetail', function ($trail) {
    $trail->parent('forums');
    $trail->push('Forum Detail', route('forums'));
});

Breadcrumbs::for('courseDetail', function ($trail) {
    $trail->parent('courses');
    $trail->push('Course Detail', route('courses'));
});

Breadcrumbs::for('updateAllocation', function ($trail) {
    $trail->parent('allocation');
    $trail->push('Update', route('allocation'));
});


Breadcrumbs::for('createAllocation', function ($trail) {
    $trail->parent('allocation');
    $trail->push('Create', route('allocation'));
});
