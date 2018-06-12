<?php 
    $STATIC_APP1 = getenv('STATIC_APP1');
	$STATIC_APP2 = getenv('STATIC_APP2');
    
	$DYNAMIC_APP1 = getenv('DYNAMIC_APP1');
    $DYNAMIC_APP2 = getenv('DYNAMIC_APP2');
?>

<VirtualHost *:80>
    ServerName demo.res.ch
    
    <Proxy "balancer://companyset">
        BalancerMember 'http://<?php print "$DYNAMIC_APP1"?>'
        BalancerMember 'http://<?php print "$DYNAMIC_APP2" ?>'
    </Proxy>
    
    <Proxy "balancer://webserverset">
        BalancerMember 'http://<?php print "$STATIC_APP1" ?>/'
        BalancerMember 'http://<?php print "$STATIC_APP2" ?>/'
    </Proxy>
    
    ProxyPass '/api/company/' 'balancer://companyset/'
    ProxyPassReverse '/api/company/' 'balancer://companyset/'
    
    ProxyPass '/' 'balancer://webserverset/'
    ProxyPassReverse '/' 'balancer://webserverset/'	 
</VirtualHost>