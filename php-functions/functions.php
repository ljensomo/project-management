<?php

function isCurrentPage($current_page, $page){
    return $current_page === $page ? 'active' : '';
}