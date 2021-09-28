
mq="xx"
i=0
cnt=`redis-cli llen uwsgi`

	mysql -u admin -padmin123 website -s -N -e  "delete from uwsgi"

while [ -n $mq ]
do
	echo $i
	
	data=`redis-cli lpop uwsgi`
	address_space=`echo $data | jq -r '.address_space'`
	rss=`echo $data | jq -r '.rss'`
	pid=`echo $data | jq -r '.pid'`
	mysql -u admin -padmin123 website -s -N -e "insert into uwsgi (address_space, rss, pid) values ('$address_space','$rss','$pid')"
	
	if [ $i == $cnt ]; then
		break;
	fi

	i=`expr $i + 1`
done