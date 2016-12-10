package kedaomail;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

import org.eclipse.jetty.server.Server;
import org.eclipse.jetty.servlet.ServletContextHandler;
import org.eclipse.jetty.servlet.ServletHolder;

public class RunWithJava {

	

	static BufferedReader br = new BufferedReader(new InputStreamReader(System.in));
	public static void main(String[] args) throws Exception
	{

		Server server=new Server(9999);
		ServletContextHandler context=new ServletContextHandler(ServletContextHandler.SESSIONS);
		context.addServlet(new ServletHolder(new InfoServlet()), "/kedao");
		server.setHandler(context);
		server.start();
		//监测数据的线程
		System.out.println("Any key to exit!");
		LSTDATA.PROGRAMRUNNING=true;
		checkThread chThread=new checkThread();
		Thread dataThread=new Thread(chThread);
		dataThread.start();
		DealNewData dlThread=new DealNewData();
		Thread dealThread=new Thread(dlThread);
		dealThread.start();
		br.readLine();
		LSTDATA.PROGRAMRUNNING=false;
		server.stop();
		
	}
}



