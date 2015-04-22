#Initial creation of time windows.  After this, they should only be updated
INSERT INTO Time_window(windowName, startTime, endTime) 
	VALUES ($windowName, $startTime, $endTime);
#Updating time windows
UPDATE Time_window SET startTime = $startTime, endTime = $endTime WHERE windowName = $windowName;

#This query will return the time window for a given windowname
SELECT startTime, endTime FROM Time_window WHERE windowName = $windowName;