#include <stdio.h>
#include <unistd.h>
#include <sys/types.h>
#include <netinet/in.h>
#include <string.h>
#include <arpa/inet.h>
#include <stdlib.h>
#include <sys/socket.h>
#include <error.h>

#define ERROR -1
#define BUFFER 1024

    int main(int argc, char **argv)
           {
           struct sockaddr_in remote_server;
           int sock;
           // char input[BUFFER];
            char input[2000];// = "I need to send something";
            char output[2000];
            int len;
            char ch;
            int i = 0;
            //char username[200];
            //char memberid[20];

           if((sock = socket(AF_INET,SOCK_STREAM,0))==ERROR)
                {
                 perror("socket");
                 exit(-1);
                 }


              remote_server.sin_family= AF_INET;
              remote_server.sin_port = htons(1199);
             // remote_server.sin_addr.s_addr = inet_addr("12.0.0.1");
             // bzero(&remote_server.sin_zero,sizeof(remote_server));
		
		    if((connect(sock,(struct sockaddr*)&remote_server,sizeof(struct sockaddr_in)))==ERROR)
                {
                  perror("connect");
                  exit(-1);
                 }

		puts("\n\nYour Request Has Been Received By The Server!!!\n\n");
		//puts("\n\nPlease enter in your username \n\n");
		//scanf("%s", username);
		//send(sock,username,strlen(username),0);
	//	puts("\n\nPlease enter in your memeber ID \n\n");
	//	scanf("%s", memberid);
	//	send(sock,memberid,strlen(memberid),0);
		puts("**********************************  SACCO FAMILY COMMAND LINE  **********************************\n\n");
		//send(sock, input, 200, 0);
	
               /* while(1)
                   {
                  puts("Please enter in your commands or as type in the word \'help\'");
                   fgets(input, 2000,stdin);
                   //puts(input);
                   send(sock,input,strlen(input),0);
                   len = recv(sock, output,2000,0);
                    //output[len]= '\0';
                    printf("%s\n", output);
                    }*/
     //keep communicating with server
    while(1)
    {
    //memset(message,0,BUFFLEN);
        puts("Please enter in your commands or as type in the word \'help\' ");
        printf("command :  ");
        //gets(input);
        fgets(input, 2000,stdin);

        /* Remove trailing newline, if they exist. */
        if ((strlen(input)>0) && (input[strlen (input) - 1] == '\n')){
            input[strlen (input) - 1] = '\0';   
        }
        //sscanf("%s",input);
        //read(0,input,2000);
        /*while(ch != '\n')
        {
          ch = getchar();
          input[i] = ch;
          i++;
        }
        input[i] = '\0';
        printf("command is : %s\n",input );*/
         
        //Send some data
        if( send(sock , input , strlen(input) , 0) < 0)
        {
            puts("Send failed");
            return 1;
        }
         
        //Receive a reply from the server
    memset(output,0,2000);
        if( len = recv(sock , output , 2000 , 0) < 0)
        {
            puts("recv failed");
            break;
        }
         
        printf("%s", output);
    }
    close(sock);
    return 0;
            }
