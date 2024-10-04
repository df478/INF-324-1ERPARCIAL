using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.Data.SqlClient;

namespace _1ERPARCIAL
{
    public partial class Form2 : Form
    {
        private string usuario;
        private string rol;
        private string connectionString = "server=(local);database=bdeleazar;Integrated Security=True;";

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
        public Form2()
        {
            InitializeComponent();
            this.usuario = usuario;
            this.rol = rol;
            CargarPropiedades();
        }

        private void CargarPropiedades()
        {
            using (SqlConnection conn = new SqlConnection(connectionString))
            {
                conn.Open();
                string sql = "SELECT * FROM Catastro";
                SqlDataAdapter adapter = new SqlDataAdapter(sql, conn);
                DataTable propiedades = new DataTable();
                adapter.Fill(propiedades);
                dataGridView1.DataSource = propiedades;
            }
        }

        private void Form2_Load(object sender, EventArgs e)
        {
            datos();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            Form4 f = new Form4();
            f.Show();
            this.Hide();
        }

        private void button2_Click(object sender, EventArgs e)
        {
            Form1 f = new Form1();
            f.Show();
            this.Close();
        }

        private void dataGridView1_CellValueChanged(object sender, DataGridViewCellEventArgs e)
        {
            DataRow dr = ds.Tables[1].Rows[e.RowIndex];
            var zona = dr["zona"].ToString();
            var xini = Convert.ToDecimal(dr["xini"]);
            var yini = Convert.ToDecimal(dr["yini"]);
            var xfin = Convert.ToDecimal(dr["xfin"]);
            var yfin = Convert.ToDecimal(dr["yfin"]);
            var superficie = Convert.ToDecimal(dr["superficie"]);
            var ci = dr["ci"].ToString();
            var distrito = dr["distrito"].ToString();
            var codigoCatastral = dr["codigo_catastral"].ToString();

            SqlConnection con = new SqlConnection();
            con.ConnectionString = "server=(local);database=bdeleazar;Integrated Security=True;";
            SqlCommand cmd = new SqlCommand();
            cmd.Connection = con;
            cmd.CommandText = "update Catastro set zona='" + zona + "', distrito='" + distrito + "' where codigo_catastral='" + codigoCatastral + "'";
            con.Open();
            cmd.ExecuteNonQuery();
            con.Close();
            datos();
            dataGridView1.DataSource = ds;
            dataGridView1.DataMember = "Catastro";
        }

        private void button3_Click(object sender, EventArgs e)
        {

          
                if (int.TryParse(textBox1.Text, out int idCatastro))
                {
                    EliminarPropiedad(idCatastro);
                }
                else
                {
                    MessageBox.Show("Por favor, ingrese un ID de catastro válido.");
                }
            
        }

        private void EliminarPropiedad(int idCatastro)
        {
            using (SqlConnection conn = new SqlConnection(connectionString))
            {
                try
                {
                    conn.Open();
                    using (SqlCommand cmd = new SqlCommand("DELETE FROM Catastro WHERE id_catastro = @idCatastro", conn))
                    {
                        cmd.Parameters.AddWithValue("@idCatastro", idCatastro);

                        int rowsAffected = cmd.ExecuteNonQuery();
                        if (rowsAffected > 0)
                        {
                            MessageBox.Show("Propiedad eliminada correctamente.");
                            CargarPropiedades();
                        }
                        else
                        {
                            MessageBox.Show("No se encontró ninguna propiedad con ese ID.");
                        }
                    }
                }
                catch (Exception ex)
                {
                    MessageBox.Show("Error al eliminar la propiedad: " + ex.Message);
                }
            }
        }
    }
}
