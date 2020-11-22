import numpy as np
import mysql.connector
import pandas as pd
from sklearn.neighbors import KNeighborsClassifier


class Api:
    def __init__(self):
        self.my_db = mysql.connector.connect(
            host="localhost",
            user="root",
            password="",
            db="sistem_pakar"
        )
        self.my_cursor = self.my_db.cursor()
        self.disease = []
        self.symptoms = []

    def knn_process(self, symptoms):
        self.symptoms = symptoms
        self.get_disease()
        self.data_frame = pd.DataFrame()
        self.gejala_rules = None
        self.get_disease_rules_symptoms()
        return self.knn_results()
    
    def get_disease(self):
        temp = self.my_cursor.execute("SELECT * FROM diseases")
        temp = self.my_cursor.fetchall()
        temp = np.array(temp)
        baris, kolom = temp.shape
        for i in range(baris):
            self.disease.append(temp[i][0])

    def get_disease_rules_symptoms(self):
        temp = self.my_cursor.execute("SELECT * FROM disease_rules_symptoms")
        temp = self.my_cursor.fetchall()
        temp = np.array(temp)
        baris_sym, kolom_sym = temp.shape
        baris_dis = len(self.disease)
        self.gejala_rules = np.zeros((baris_sym, 2), dtype=int)
        for i in range(baris_dis):
            for j in range(baris_sym):
                if self.disease[i] == temp[j][1]:
                    self.gejala_rules[j][1] = self.disease[i]
                    self.gejala_rules[j][0] = temp[j][2]
    
    def knn_results(self):
        self.data_frame = pd.DataFrame(self.gejala_rules, columns=["Gejala", "Penyakit"])
        # x adalah input
        # y adalah output : klasifikasi
        # x => y
        # y => gaonok

        x = self.data_frame["Gejala"].values
        # x adalah gelajala => input yang menyatakan output penyakit apa
        y = self.data_frame["Penyakit"].values
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
        x = x.reshape(-1, 1)
        knn.fit(x, y)
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
        predict = np.array([self.symptoms]).T
        #predict = np.array([[32]]).T
        res = knn.predict(predict)
        # [1,1,1,7,8,9]
        # membuat array jumlah baris = penyakit , jml kolom = 2
        # penyakit diseleksi pakah data prediksi mu masuk penyakit mana
        # ketika if sama += 1 pada id penyakit bersangkutan
        hasil_penyakit = np.zeros((len(self.disease), 2), dtype=int)
        #panjang penyakit
        for i in range(len(self.disease)):
            # panjang prediksi
            hasil_penyakit[i][0] = self.disease[i]
            for j in range(len(res)):
                if self.disease[i] == res[j]:
                    # indexks [i][0] = penyakit
                    # jumlha data yang sering munclul terhadap id penyakit
                    # indeks [i][1] = count of data yg sering keluar
                    hasil_penyakit[i][1] += 1
        #disorting secara descending
        sort_rank = hasil_penyakit[hasil_penyakit[:, 1].argsort()[::-1]]
        hasil_prediksi = sort_rank[0][0]
        # for i in range(prediksi)
        # temp = last[i]
        # temp => temp[i]+1
        # index += 1
        # index
        # berapa banyak data yang mok lempar ke website
        sql = "SELECT * FROM diseases WHERE id='{}'".format(hasil_prediksi)
        hasil_query_res = self.my_cursor.execute(sql)
        hasil_query_res = self.my_cursor.fetchall()
        hasil_query_res = hasil_query_res[0][0]
        print(hasil_query_res)
        return hasil_query_res

        # web => 1
        # SELECT * FROM disease WHERE nama_disease = "Sing dikirim python"
        # P1


if __name__ == "__main__":
    api = Api()
