
mq="xx"
 i=0
 cnt=`redis-cli llen nginx`

	mysql -u admin -padmin123 website -s -N -e  "delete from nginx"

 while [ -n $mq ] 
 do
 	echo $i	
	
 	data=`redis-cli lpop nginx`
	ip=`echo $data | jq -r '.ip'`
 	date=`echo $data | jq -r '.date'`
	method=`echo $data | jq -r '.method'`
 	status=`echo $data | jq -r '.status'`
	ms=`echo $data | jq -r '.ms'`
 	site=`echo $data | jq -r '.site'`
 	rt=`echo $data | jq -r '.rt'`
	uct=`echo $data | jq -r '.uct'`
	uht=`echo $data | jq -r '.uht'`
	urt=`echo $data | jq -r '.urt'`
	gz=`echo $data | jq -r '.gz'`
	mysql -u admin -padmin123 website -s -N -e "insert into nginx (ip, date, method, status, ms, site, rt, uct, uht, urt, gz) values ('$ip','$date','$method','$status','$ms','$site','$rt','$uct','$uht','$urt','$gz')"
	
	if [[ $i == $cnt ]]; then
		break;
 	fi

 	i=`expr $i + 1`
  done
