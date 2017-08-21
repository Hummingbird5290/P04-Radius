<?php
//returns a string appropriate to execute rrdtool for cpu
function cpu_graph($outfile, $timerange, $smoothsecs) {
	return '/usr/bin/sudo /usr/bin/rrdtool graph \
	'.$outfile.'\
	--imgformat PNG \
	--color BACK#00ff0000 \
	--color AXIS#6699cc \
	--color ARROW#6699cc \
	--color SHADEA#00000000 \
	--color SHADEB#00000000 \
	--width 800 \
	--height 300 \
	--lower-limit 0 \
	--start end-'.$timerange.'\
	--end now \
	DEF:cpu0-system=/usr/local/collectd/var/lib/collectd/rrd/localhost/cpu-0/cpu-system.rrd:value:AVERAGE \
	DEF:cpu1-system=/usr/local/collectd/var/lib/collectd/rrd/localhost/cpu-1/cpu-system.rrd:value:AVERAGE \
	DEF:cpu2-system=/usr/local/collectd/var/lib/collectd/rrd/localhost/cpu-2/cpu-system.rrd:value:AVERAGE \
	DEF:cpu3-system=/usr/local/collectd/var/lib/collectd/rrd/localhost/cpu-3/cpu-system.rrd:value:AVERAGE \
	CDEF:system-avg=cpu0-system,cpu1-system,cpu2-system,cpu3-system,4,AVG \
	CDEF:system-smoothed=system-avg,'.$smoothsecs.',TREND \
	DEF:cpu0-wait=/usr/local/collectd/var/lib/collectd/rrd/localhost/cpu-0/cpu-wait.rrd:value:AVERAGE \
	DEF:cpu1-wait=/usr/local/collectd/var/lib/collectd/rrd/localhost/cpu-1/cpu-wait.rrd:value:AVERAGE \
	DEF:cpu2-wait=/usr/local/collectd/var/lib/collectd/rrd/localhost/cpu-2/cpu-wait.rrd:value:AVERAGE \
	DEF:cpu3-wait=/usr/local/collectd/var/lib/collectd/rrd/localhost/cpu-3/cpu-wait.rrd:value:AVERAGE \
	CDEF:wait-avg=cpu0-wait,cpu1-wait,cpu2-wait,cpu3-wait,4,AVG \
	CDEF:wait-smoothed=wait-avg,'.$smoothsecs.',TREND \
	DEF:cpu0-user=/usr/local/collectd/var/lib/collectd/rrd/localhost/cpu-0/cpu-user.rrd:value:AVERAGE \
	DEF:cpu1-user=/usr/local/collectd/var/lib/collectd/rrd/localhost/cpu-1/cpu-user.rrd:value:AVERAGE \
	DEF:cpu2-user=/usr/local/collectd/var/lib/collectd/rrd/localhost/cpu-2/cpu-user.rrd:value:AVERAGE \
	DEF:cpu3-user=/usr/local/collectd/var/lib/collectd/rrd/localhost/cpu-3/cpu-user.rrd:value:AVERAGE \
	CDEF:user-avg=cpu0-user,cpu1-user,cpu2-user,cpu3-user,4,AVG \
	CDEF:user-smoothed=user-avg,'.$smoothsecs.',TREND \
	DEF:cpu0-nice=/usr/local/collectd/var/lib/collectd/rrd/localhost/cpu-0/cpu-nice.rrd:value:AVERAGE \
	DEF:cpu1-nice=/usr/local/collectd/var/lib/collectd/rrd/localhost/cpu-1/cpu-nice.rrd:value:AVERAGE \
	DEF:cpu2-nice=/usr/local/collectd/var/lib/collectd/rrd/localhost/cpu-2/cpu-nice.rrd:value:AVERAGE \
	DEF:cpu3-nice=/usr/local/collectd/var/lib/collectd/rrd/localhost/cpu-3/cpu-nice.rrd:value:AVERAGE \
	CDEF:nice-avg=cpu0-nice,cpu1-nice,cpu2-nice,cpu3-nice,4,AVG \
	CDEF:nice-smoothed=nice-avg,'.$smoothsecs.',TREND \
	CDEF:wait-wm=system-smoothed,wait-smoothed,+ \
	CDEF:user-wm=wait-wm,user-smoothed,+ \
	CDEF:nice-wm=user-wm,nice-smoothed,+ \
	COMMENT:"        " \
	COMMENT:"  min   " \
	COMMENT:"  max   " \
	COMMENT:"average\l" \
	AREA:nice-wm#66cc33:"Nice    " \
	LINE1:nice-wm#339900 \
	VDEF:nice-av-avg=nice-avg,AVERAGE \
	GPRINT:nice-avg:MIN:"%4.1lf%%   " \
	GPRINT:nice-avg:MAX:"%4.1lf%%   " \
	GPRINT:nice-av-avg:"%4.1lf%%\l" \
	AREA:user-wm#ffcc33:"User    " \
	LINE1:user-wm#CC9900 \
	VDEF:user-av-avg=user-avg,AVERAGE \
	GPRINT:user-avg:MIN:"%4.1lf%%   " \
	GPRINT:user-avg:MAX:"%4.1lf%%   " \
	GPRINT:user-av-avg:"%4.1lf%%\l" \
	AREA:wait-wm#cc6633:"Wait    " \
	LINE1:wait-wm#993300 \
	VDEF:wait-av-avg=wait-avg,AVERAGE \
	GPRINT:wait-avg:MIN:"%4.1lf%%   " \
	GPRINT:wait-avg:MAX:"%4.1lf%%   " \
	GPRINT:wait-av-avg:"%4.1lf%%\l" \
	AREA:system-smoothed#993333:"System  " \
	LINE1:system-smoothed#990000 \
	VDEF:system-av-avg=system-avg,AVERAGE \
	GPRINT:system-avg:MIN:"%4.1lf%%   " \
	GPRINT:system-avg:MAX:"%4.1lf%%   " \
	GPRINT:system-av-avg:"%4.1lf%%\l" \
';
}
?>
