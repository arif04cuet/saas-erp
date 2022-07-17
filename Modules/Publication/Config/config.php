<?php

return [
    'name' => 'Publication',

    // warning: proof status keys used for database enum
    'proof_status' => [
        'initiated' => 'initiated',
        'first_proof' => 'first_proof',
        'first_proof_done' => 'first_proof_done',
        'second_proof' => 'second_proof',
        'second_proof_done' => 'second_proof_done',
        'final_proof' => 'final_proof',
        'final_proof_done' => 'final_proof_done'
    ],
    'status' => [
        'draft' => 'draft',
        'on_press' => 'on_press',
        'back_to_researcher' => 'back_to_researcher',
        'completed' => 'completed'
    ],
    'status_for_press' => [
        'initiated' => 'initiated',
        'first_proof_done' => 'first_proof_done',
        'second_proof_done' => 'second_proof_done',
        'final_proof_done' => 'final_proof_done'
    ],
    'status_for_researcher' => [
        'first_proof' => 'first_proof',
        'second_proof' => 'second_proof',
        'final_proof' => 'final_proof',
    ]
];
