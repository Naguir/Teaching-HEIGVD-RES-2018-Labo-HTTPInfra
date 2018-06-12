<?php 
    $STATIC_APP1 = getenv('STATIC_APP1');
	$STATIC_APP2 = getenv('STATIC_APP2');
    
	$DYNAMIC_APP1 = getenv('DYNAMIC_APP1');
    $DYNAMIC_APP2 = getenv('DYNAMIC_APP2');
?>

<VirtualHost *:80>
    ServerName demo.res.ch
    
    <Proxy "balancer://company">
        BalancerMember 'http://<?php print "$DYNAMIC_APP1"?>'
        BalancerMember 'http://<?php print "$DYNAMIC_APP2" ?>'
    </Proxy>
    
    <Proxy "balancer://webserver">
        BalancerMember 'http://<?php print "$STATIC_APP1" ?>/'
        BalancerMember 'http://<?php print "$STATIC_APP2" ?>/'
    </Proxy>
    
    ProxyPass '/api/company/' 'balancer://company/'
    ProxyPassReverse '/api/company/' 'balancer://company/'
    
    ProxyPass '/' 'balancer://webserver/'
    ProxyPassReverse '/' 'balancer://webserver/'	 
</VirtualHost>