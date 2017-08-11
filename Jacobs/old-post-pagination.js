
		var pathname=location.pathname,
			queryString=location.search,
			protocol=location.protocol + "//",
			yearRegEx=/(19[5-9]\d|20[0-4]\d|2050)/,
			host=location.host,
			isValid=yearRegEx.test(pathname),
			isMonth=false,
			theDate=new Date(),
			theYear=theDate.getFullYear(),
			pageYear,
			pageMonth,
			prevYear,
			nextYear,
			prevMonth,
			nextMonth,
			postBeforeText,
			postAfterText,
			postBeforeURL,
			postAfterURL;
		
		if(isValid){
			
			if(pathname.length > 6){
				postBeforeText="Last Month";
				postAfterText="Next Month";
				isMonth=true;
			}else{
		    	postBeforeText="Last Year";
				postAfterText="Next Year";
			}
			
			pageYear=Number(pathname.slice(1,5));
			prevYear=Number(pageYear) - 1;
			nextYear=Number(pageYear) + 1;
			
			if(!isMonth){
				
				try{
					postBeforeURL= protocol + host + "/" + prevYear + "/" + queryString;
					postAfterURL = protocol + host  + "/" + nextYear + "/" + queryString;
				}catch(e){
					console.log(e);
				}finally{
					postBeforeURL= protocol + host  + "/" + prevYear + "/";
					postAfterURL = protocol + host  + "/" + nextYear + "/";		
				}

				if(pageYear >= theYear){
					jQuery(".next-post-link").remove();
					jQuery(".prev-post-link a").attr("href",postBeforeURL).text(postBeforeText);
				}else{
					jQuery(".prev-post-link a").attr("href",postBeforeURL).text(postBeforeText);
					jQuery(".next-post-link a").attr("href",postAfterURL).text(postAfterText);
				}
			}else{
				pageMonth=Number(pathname.slice(6,8));
				prevMonth=Number(pageMonth) - 1;
				nextMonth=Number(pageMonth) + 1;
				
				if(prevMonth < 10){
					prevMonth= "0" + prevMonth.toString(); 
				}
				
				if(nextMonth < 10){
					nextMonth= "0" + nextMonth.toString(); 
				}
				
				
				try{
					postBeforeURL= protocol + host + "/" + pageYear + "/" + prevMonth + "/" + queryString;
					postAfterURL = protocol + host  + "/" + pageYear + "/" + nextMonth + "/" + queryString;
				}catch(e){
					console.log(e);
				}finally{
					postBeforeURL= protocol + host  + "/"  + pageYear + "/" + prevMonth + "/";
					postAfterURL = protocol + host  + "/" + pageYear +  "/" + nextMonth + "/";		
				}
				

				if(pageYear >= theYear && nextMonth > 12){
					jQuery(".next-post-link").remove();
					jQuery(".prev-post-link a").attr("href",postBeforeURL).text(postBeforeText);
				}else{
					jQuery(".prev-post-link a").attr("href",postBeforeURL).text(postBeforeText);
					jQuery(".next-post-link a").attr("href",postAfterURL).text(postAfterText);
				}
			}			
			
		}