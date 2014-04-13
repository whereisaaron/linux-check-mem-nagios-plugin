#!/bin/sh
# Sample install steps for CentOS 6.5, YMMV

cp check_mem.php /usr/share/nagios/html/pnp4nagios/templates/
cp check_mem /usr/lib64/nagios/plugins/
/sbin/restorecon -v /usr/lib64/nagios/plugins/check_mem

# Assuming you are using nrpe
# Now add the command to nrpe configuration /etc/nagios/nrpe.config
#   command[check_mem]=/usr/lib64/nagios/plugins/check_mem -w 70 -c 90
# and reload nrpe
#   service nrpe reload
# then test manually
#   /usr/lib64/nagios/plugins/check_nrpe -H target.host.name -c check_mem
# now go configure the service in Nagios, and associate with your hosts/hostgroups
#
# define service {
#         name                            check-nrpe-linux-mem
#         service_description             Check Linux memory
#         use                             generic-service
#         check_command                   check_nrpe!check_mem
#         max_check_attempts              1
#         check_interval                  5
#         retry_interval                  1
#         register                        0
# }
#
