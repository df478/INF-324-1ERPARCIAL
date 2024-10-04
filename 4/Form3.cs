using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Data.SqlClient;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace _1ERPARCIAL
{
    public partial class Form3 : Form
    {

        DataSet ds = new DataSet();

        private void datos()
        {
            ds.Clear();
            SqlConnection con = new SqlConnection();
            con.ConnectionString = "server=(local);database=bdeleazar;Integrated Security=True;";
            SqlDataAdapter ada = new SqlDataAdapter();
            ada.SelectCommand = new SqlCommand();
            ada.SelectCommand.Connection = con;
            ada.SelectCommand.CommandText = "select * from Persona";
            ada.SelectCommand.CommandType = CommandType.Text;
            ada.Fill(ds, "Persona");
            ada.SelectCommand.CommandText = "select * from Catastro";
            ada.SelectCommand.CommandType = CommandType.Text;
            ada.Fill(ds, "Catastro");
        }

        public Form3()
        {
            InitializeComponent();
        }

        private void label2_Click(object sender, EventArgs e)
        {

        }

        private void button2_Click(object sender, EventArgs e)
        {
            Form1 f = new Form1();
            f.Show();
            this.Close();
        }

        private void Form3_Load(object sender, EventArgs e)
        {
            datos();
            dataGridView1.DataSource = ds;
            dataGridView1.DataMember = "Catastro";
        }
    }
}
