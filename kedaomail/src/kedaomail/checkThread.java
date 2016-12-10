package kedaomail;

public class checkThread implements Runnable{

	@Override
	public void run() {
		
		while(true&&LSTDATA.PROGRAMRUNNING)
		{
			if(LSTDATA.ipMap.size()!=0)
			{
				LSTDATA.newInfoFlag=true;
			}
			else
			{
				LSTDATA.newInfoFlag=false;
			}
			System.out.println("CHECK THREAD IS RUNNING");
			try {
				Thread.sleep(LSTDATA.checkNewInfoTime);
			} catch (InterruptedException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
		}
		System.out.println("CHECK THREAD CLOSE");
		
	}

}
