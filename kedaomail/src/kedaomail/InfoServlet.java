package kedaomail;

import java.io.IOException;
import java.io.PrintWriter;
import java.util.ArrayList;
import java.util.Set;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

public class InfoServlet extends HttpServlet{
	
	public void doGet(HttpServletRequest request,HttpServletResponse response) throws IOException
	{
		String responseStr="";
		String ipParam=request.getParameter("ip").toString().trim();
		String emailParam=request.getParameter("email").toString().trim();
		System.out.println("GET:"+ipParam+" "+emailParam);
		
		if(emailParam!=null&&emailParam!=""&&emailParam.length()>2&&judgeMailAddress(emailParam.trim()))
		{
			emailParam=emailParam.toLowerCase();
			if(ipParam==null||ipParam=="")
			{
				ipParam="0.0.0.0";
			}
			ArrayList<String> ipSendMail=LSTDATA.ipMap.get(ipParam);
			if(ipSendMail==null)
			{
				ArrayList<String> tempList=new ArrayList<String>();
				tempList.add(emailParam);
				LSTDATA.ipMap.put(ipParam, tempList);
			}
			else
			{
				ipSendMail.add(emailParam);
			}
			responseStr="OK";
		}
		else
		{
			responseStr="WRONG EMAIL";
		}
		PrintWriter writer=response.getWriter();
		writer.append(responseStr);
		writer.flush();
		writer.close();
	}
	private boolean judgeMailAddress(String email)
	{
		String judge= "^([a-zA-Z0-9_\\-\\.]+)@((\\[[0-9]{1,3}\\.[0-9]{1,3}\\.[0-9]{1,3}\\.)|(([a-zA-Z0-9\\-]+\\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\\]?)$";
		Pattern pattern = Pattern.compile(judge);
		 Matcher matcher = pattern.matcher(email);
		 boolean b= matcher.matches();
		 return b;
	}

}
