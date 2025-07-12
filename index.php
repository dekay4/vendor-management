<?php

if ($_COOKIE["api_key"] == '') {

    header("Location:login?logout=1");
} else {

    header("Location: dashboard/");
}
