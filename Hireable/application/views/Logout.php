<?php
if(!$this->session->userdata('logged in'))
{
    header('location:'.site_url("Login"));
}