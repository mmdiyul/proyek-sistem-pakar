import numpy as np
import mysql.connector

class Main():
    def __init__(self):
        self.mydb = mysql.connector.connect(
            host = "localhost",
            user = "root",
            password = "",
            db = "sistem_pakar"
        )
        self.my_cursor = self.mydb.cursor()
        self.penyakit_temp = self.my_cursor.execute("SELECT * FROM diseases")
        self.penyakit_temp = self.my_cursor.fetchall()
        self.penyakit = []
        for i in self.penyakit_temp:
            self.penyakit.append(i[1])
        
        self.g_count = self.my_cursor.execute("SELECT COUNT(symptoms.code) FROM `symptoms`")
        self.g_count = self.my_cursor.fetchall()[0][0]
        self.rules = np.zeros((len(self.penyakit),self.g_count + 1),dtype=object)
        
        for i in range(0,len(self.penyakit)):
            self.rules[i][0] = self.penyakit[i]
        
        self.p1 = [1, 2, 3, 4, 5, 6, 7,13, 23, 29, 32]
        self.p2 = [6, 8, 9, 10, 11, 13,18, 19, 29, 32]
        self.p3 = [5,6,7,8,10,11,12,13,14,18,23,29,32]
        self.p4 = [5,13,15,16,17,19,20,32]
        self.p5 = [2,3,4,5,7,8,11,21,22,23,32]
        self.p6 = [3,4,5,6,7,21,22,23,24,32]
        self.p7 = [3,7,8,10,11,13,18,28,29,30,31,32]
        self.p8 = [3,5,8,10,11,12,13,18,25,26,27,32]
        self.p9 = [32]
        baris , kolom = self.rules.shape
        for i in range(baris):
            idx = 1
            for j in range(1,kolom):
                if(i == 0 and idx in self.p1):
                    self.rules[i][j] = 1
                elif(i == 1 and idx in self.p2):
                    self.rules[i][j] = 1
                elif(i == 2 and idx in self.p3):
                    self.rules[i][j] = 1
                elif(i == 3 and idx in self.p4):
                    self.rules[i][j] = 1
                elif(i == 4 and idx in self.p5):
                    self.rules[i][j] = 1
                elif(i == 5 and idx in self.p6):
                    self.rules[i][j] = 1
                elif(i == 6 and idx in self.p7):
                    self.rules[i][j] = 1
                elif(i == 7 and idx in self.p8):
                    self.rules[i][j] = 1
                elif(i == 8 and idx in self.p9):
                    self.rules[i][j] = 1
                idx += 1
        
        self.training = self.rules
        self.testing = [1,0,1,0,0,1,0,0,0,1,1,0,0,0,0,1,1,1,0,0,0,0,1,1,0,0,0,0,0,0,0,0]
        #self.testing = [1 ,1 ,1 ,1 ,1 ,1 ,1 ,0 ,0 ,0 ,0 ,0 ,1 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,0 ,1 ,0 ,0 ,0 ,0 ,0 ,1 ,0 ,0 ,1]
        self.compute_knn()

    def compute_knn(self):
        for i in range(self.training.shape[0]):
            idx = np.delete(self.training[i],0)
            # Pengurangan dan kuadrat
            nilai = (self.testing - idx)**2
            nilai = np.sum(nilai)
            import math
            nilai = math.sqrt(nilai)
            nilai = round(nilai,3)
            print("ED For " ,self.training[i][0] , " : ",  nilai)
        #dirank 
        #dikembalikan ke database :
        #dia P1,P2,P3 dll distorting
        #json => [P1,P2,P3,P5,P7]
        #di php itu tau data yang sudah jadi
        # misal, pyhon nilai sama 3.17 = 3 penyakit
        # dia dianggap 3 penyakit
        # atau 1 penyakit

if __name__ == "__main__":
    main = Main()