<?php

namespace Deployer;

require 'recipe/codeigniter.php';

// Project name
set( 'application', 'my_project' );

// Project repository
set( 'repository', 'https://github.com/gopalindians/edu-app.git' );

// [Optional] Allocate tty for git clone. Default value is false.
set( 'git_tty', false );

// no of releases to keep
set( 'keep_releases', 5 );

set( 'ssh_multiplexing', false );

// Shared files/dirs between deploys 
add( 'shared_files', [] );
add( 'shared_dirs', [] );

// Writable dirs by web server 
add( 'writable_dirs', [] );


// Hosts


host( 'AAP_URL' )
	->user( 'USER_NAME' )
	->port( 22 )
	->forwardAgent( true )
	->addSshOption( 'UserKnownHostsFile', '/dev/null' )
	->addSshOption( 'StrictHostKeyChecking', 'no' );

// Tasks
task( 'build', function () {
	run( 'cd {{release_path}} && build' );
} );

task( 'pwd', function () {
	$result = run( 'pwd' );
	writeln( "Current dir: $result" );
} );

// [Optional] if deploy fails automatically unlock.
after( 'deploy:failed', 'deploy:unlock' );

