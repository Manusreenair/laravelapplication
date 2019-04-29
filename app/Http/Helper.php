<?php
function isSuperAdmin()
{
	if(Auth::user()->id==1)
		return true;
	return false;
}