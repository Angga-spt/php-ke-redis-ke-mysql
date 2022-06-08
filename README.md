### php & Shel script from log->redis->mysql

first php file to parse the data we want example we want to separate the ip and date i take from the nginx.log log data then 1 line
I put it in the regex and I coded the regex like the one in the php file
for the same uwsgi file, only the data is different, the usage is almost the same

and for the sh file to retrieve data from redis which has been made into json because the php code above sends json data to redis so we just take it using a shell script and use the LPOP function
