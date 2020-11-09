import numpy as np
import mysql.connector
import pandas as pd
from sklearn.neighbors import KNeighborsClassifier

class Api:
    def __init__(self):
        self.mydb = mysql.connector.connect(
            host="localhost",
            user="root",
            password="",
            db="sistem_pakar"
        )
        self.my_cursor = self.mydb.cursor()
        self.disease = []
        self.getDisease()
        self.dataFrame = pd.DataFrame()
        self.gejalaRules = None
        self.getDiseaseRulesSymptoms()
        self.KnnResult()
    
    def getDisease(self):
        temp = self.my_cursor.execute("SELECT * FROM diseases")
        temp = self.my_cursor.fetchall()
        temp = np.array(temp)
        baris , kolom = temp.shape
        for i in range(baris):
            self.disease.append(temp[i][0])

    def getDiseaseRulesSymptoms(self):
        temp = self.my_cursor.execute("SELECT * FROM disease_rules_symptoms")
        temp = self.my_cursor.fetchall()
        temp = np.array(temp)
        baris_sym , kolom_sym = temp.shape
        baris_dis = len(self.disease)
        self.gejalaRules = np.zeros((baris_sym,2),dtype=int)
        for i in range(baris_dis):
            for j in range(baris_sym):
                if(self.disease[i] == temp[j][1]):
                    self.gejalaRules[j][1] = self.disease[i]
                    self.gejalaRules[j][0] = temp[j][2]
    
    def KnnResult(self):
        self.dataFrame = pd.DataFrame(self.gejalaRules,columns=["Gejala","Penyakit"])
        # x adalah input
        # y adalah output : klasifikasi
        # x => y
        # y => gaonok

        x = self.dataFrame["Gejala"].values
        # x adalah gelajala => input yang menyatakan output penyakit apa
        y = self.dataFrame["Penyakit"].values
        # y => ouput dari gejala yang ada

        # librari KNN
        # 1 tetangga terdekat => data mu unique P1,P2,P3 
        # gak mungkin 1 penyakit punya gejala yang sama , pasti ono lebihi / kurangi
        # penyakit A = 1,2
        # penyakit B = 1
        knn = KNeighborsClassifier(1)
        # penyakit => gejala lebih dari 1 / 1 
        # penyakit A => 1
        # penyakit B => 1,2,3,4
        # x = [1,2,3,4,5] => 1 * 5
        # y = 9 baris
        # x => x.T
        x = x.reshape(-1,1)
        knn.fit(x,y)
        # id penyakit
        # pertanyaakn => gejala =>
        # gejala fk id Penyakit
        # Apakah Anda Gejala 1
        # rules mu gejala 1 => 1 , 2 ,3 
        # Id Kirim Python =>
        # [30,31,0,]
        # [1 => 1]
        # [2 => 2]
        # [3 => 1 , 2,  3 ]
        # [!= 0 => 1,3,4,5]
        # data dinamis dari web
        predict = np.array([[1,2,3,4,5,6,7,13,23,29,32]]).T
        #predict = np.array([[32]]).T
        res = knn.predict(predict)
        # [1,1,1,7,8,9]
        # membuat array jumlah baris = penyakit , jml kolom = 2
        # penyakit diseleksi pakah data prediksi mu masuk penyakit mana
        # ketika if sama += 1 pada id penyakit bersangkutan
        hasilPenyakit = np.zeros((len(self.disease),2),dtype=int)
        #panjang penyakit
        for i in range(len(self.disease)):
            # panjang prediksi
            hasilPenyakit[i][0] = self.disease[i] 
            for j in range(len(res)):
                if(self.disease[i] == res[j]):
                    # indexks [i][0] = penyakit
                    # jumlha data yang sering munclul terhadap id penyakit
                    # indeks [i][1] = count of data yg sering keluar
                    hasilPenyakit[i][1] += 1
        #disorting secara descending
        sort_rank = hasilPenyakit[hasilPenyakit[:,1].argsort()[::-1]]
        hasilPrediksi = sort_rank[0][0]
        # for i in range(prediksi)
        # temp = last[i]
        # temp => temp[i]+1
        # index += 1
        # index
        # berapa banyak data yang mok lempar ke website
        sql = "SELECT * FROM diseases WHERE id='{}'".format(hasilPrediksi)
        hasilQueryRes = self.my_cursor.execute(sql)
        hasilQueryRes = self.my_cursor.fetchall()
        hasilQueryRes = hasilQueryRes[0][0]
        print(hasilQueryRes)

        # web => 1
        # SELECT * FROM disease WHERE nama_disease = "Sing dikirim python"
        # P1

        

if __name__ == "__main__":
    api = Api()