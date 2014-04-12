<?php

	$ds_name[1] = "sysinfo";

	$opt[1] = "--vertical-label \"Bytes\" -l0 --title \"Memory usage for $hostname / $servicedesc\" ";

	# Total Memory
	$def[1] = "DEF:mem_total=$RRDFILE[1]:$DS[1]:AVERAGE " ;
	# Used Memory
	$def[1] .= "DEF:mem_used=$RRDFILE[1]:$DS[2]:AVERAGE " ;
	# Cache
	$def[1] .= "DEF:mem_cache=$RRDFILE[1]:$DS[3]:AVERAGE " ;
	# Buffer
	$def[1] .= "DEF:mem_buffer=$RRDFILE[1]:$DS[4]:AVERAGE " ;
	
	# Memory Cache
	$def[1] .= rrd::cdef("mem_cache_tmp", "mem_cache,mem_buffer,+,mem_used,+");
	$def[1] .= rrd::area("mem_cache_tmp", "#DCDDD5", "Disk Cache");

	$def[1] .= "GPRINT:mem_cache:LAST:\"%3.2lf %sB Last \" ";
        $def[1] .= "GPRINT:mem_cache:MAX:\"%3.2lf %sB Max \" ";
        $def[1] .= "GPRINT:mem_cache" . ':AVERAGE:"%3.2lf %sB Average \j" ';

	# Memory Buffer
	$def[1] .= rrd::cdef("mem_buffer_tmp", "mem_buffer,mem_used,+");
	$def[1]	.= rrd::area("mem_buffer_tmp", "#3E606F", "I/O Buffers");

	$def[1] .= "GPRINT:mem_buffer:LAST:\"%3.2lf %sB Last \" ";
        $def[1] .= "GPRINT:mem_buffer:MAX:\"%3.2lf %sB Max \" ";
        $def[1] .= "GPRINT:mem_buffer" . ':AVERAGE:"%3.2lf %sB Average \j" ';

	# Memory Used
	$def[1]	.= rrd::area("mem_used", "#193441", "Processes");

	$def[1] .= "GPRINT:mem_used:LAST:\"%3.2lf %sB Last \" ";
	$def[1] .= "GPRINT:mem_used:MAX:\"%3.2lf %sB Max \" ";
	$def[1] .= "GPRINT:mem_used" . ':AVERAGE:"%3.2lf %sB Average \j" ';

	# Memory Total
	$def[1] .= rrd::line1("mem_total", "#000000", "Total");

	$def[1] .= "GPRINT:mem_total:LAST:\"%3.2lf %sB Last \" ";
        $def[1] .= "GPRINT:mem_total:MAX:\"%3.2lf %sB Max \" ";
        $def[1] .= "GPRINT:mem_total" . ':AVERAGE:"%3.2lf %sB Average \j" ';

	if ($WARN[2] != "") {
        	$def[1] .= "HRULE:$WARN[2]#ffff00:\"Warning threshold for Processes\j\" ";
	}
	if ($CRIT[2] != "") {
        	$def[1] .= "HRULE:$CRIT[2]#ff0000:\"Critical threshold for Processes\" ";
	}
?>
