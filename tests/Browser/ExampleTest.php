<?php

it('returns a successful response', function () {
   visit('/')->assertSee('stop');

   //->debug() add this to see the window popup and see what it sees
});
