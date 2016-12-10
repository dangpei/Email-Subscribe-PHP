package kedaomail;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

public class LSTDATA {

	public static Map<String,ArrayList<String>> ipMap=new HashMap<String,ArrayList<String>>();
	public static int checkNewInfoTime=5000;
	public static boolean newInfoFlag=false;
	public static int WRITESPEED=2000;
	public static int checkNewDataSpeed=3000;
	public static boolean PROGRAMRUNNING=false;
}
