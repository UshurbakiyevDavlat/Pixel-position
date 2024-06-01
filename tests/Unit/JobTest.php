<?php

it('can load employer', function () {
    // arrange
    $employer = \App\Models\Employer::factory()->create();
    $job = \App\Models\Job::factory()->create(['employer_id' => $employer->id]);

    // action and assert
    expect($job->employer)->is($employer)->toBeTrue();
});

it('can create tags', function () {
    //arrange
    $job = \App\Models\Job::factory()->create();

    //act
    $job->tag('testTag');
    //assert
    expect($job->tags->pluck('title')->first())->toBeIn(['testTag']);
});
