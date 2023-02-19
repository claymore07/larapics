<?php

namespace App\Enums;

enum Role: string
{
    case Admin = 'Admin';
    case Editor = 'Editor';
    case Author = 'Author';
}


// class Role {
//     public const Admin = 'Admin';
//     public const Editor = 'Editor';
//     public const Author = 'Author';
// }
