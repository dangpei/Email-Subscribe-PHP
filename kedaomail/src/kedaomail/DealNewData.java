package kedaomail;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.net.URL;
import java.net.URLConnection;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import java.util.Set;

public class DealNewData implements Runnable{

	@Override
	public void run() {
		
		while(true&&LSTDATA.PROGRAMRUNNING)
		{
			if(LSTDATA.newInfoFlag==true)
			{
				System.out.println("Start to write email to mySQL");
				while(LSTDATA.ipMap.size()>0)
				{
					Set<String> st=LSTDATA.ipMap.keySet();
					Object[] alst=st.toArray();
					int nullSize=0;
					for(int i=0;i<alst.length;i++)
					{
						boolean needSlee=true;
						ArrayList<String> lst=LSTDATA.ipMap.get(alst[i].toString().trim());
						if(lst==null||lst.size()==0)
						{
							nullSize++;
							needSlee=false;
						}
						else
						{
							String needToSend=lst.get(0);
							writeToDB(needToSend);
							lst.remove(0);
						}
						if(needSlee)
						{
							try {
								Thread.sleep(LSTDATA.WRITESPEED);
							} catch (InterruptedException e) {
								// TODO Auto-generated catch block
								e.printStackTrace();
							}
						}
					}
					if(nullSize==LSTDATA.ipMap.size())
					{
						LSTDATA.ipMap=new HashMap<String,ArrayList<String>>();
					
					}
					
					
				}
				System.out.println("Stop to write email to mySQL");
			}
			System.out.println("DATA  THREAD IS RUNNING");
			try {
				Thread.sleep(LSTDATA.checkNewDataSpeed);
			} catch (InterruptedException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
			
			
		}
		System.out.println("DATA THREAD CLOSE");
		
	}
	private void writeToDB(String email)
	{
		System.out.println("    WRITE: "+email);
		String s=sendGet("http://localhost/kedao/writetomysqli.php", "email="+email.trim());
	    System.out.println("WriteResult:"+s);
	}
    private String sendGet(String url, String param) {
        String result = "";
        BufferedReader in = null;
        try {
            String urlNameString = url + "?" + param;
            URL realUrl = new URL(urlNameString);
            URLConnection connection = realUrl.openConnection();
            connection.setRequestProperty("accept", "*/*");
            connection.setRequestProperty("connection", "Keep-Alive");
            connection.setRequestProperty("user-agent",
                    "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1;SV1)");
            connection.connect();
            Map<String, List<String>> map = connection.getHeaderFields();
            in = new BufferedReader(new InputStreamReader(
                    connection.getInputStream()));
            String line;
            while ((line = in.readLine()) != null) {
                result += line;
            }
        } catch (Exception e) {
            System.out.println("发送GET请求出现异常！" + e);
            e.printStackTrace();
        }
        // 使用finally块来关闭输入流
        finally {
            try {
                if (in != null) {
                    in.close();
                }
            } catch (Exception e2) {
                e2.printStackTrace();
            }
        }
        return result;
    }

}
