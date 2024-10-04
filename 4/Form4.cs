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
using static System.Windows.Forms.VisualStyles.VisualStyleElement;

namespace _1ERPARCIAL
{
    public partial class Form4 : Form
    {
        private string connectionString = "server=(local);database=bdeleazar;Integrated Security=True;";
        public Form4()
        {
            InitializeComponent();
            LoadCIData();
        }
        private void LoadCIData()
        {
            using (SqlConnection conn = new SqlConnection(connectionString))
            {
                conn.Open();
                SqlCommand cmd = new SqlCommand("SELECT ci, nombre, apellido FROM Persona", conn);
                SqlDataReader reader = cmd.ExecuteReader();

                while (reader.Read())
                {
                    string fullName = $"{reader["nombre"]} {reader["apellido"]} ({reader["ci"]})";
                    comboBoxCi.Items.Add(new { Text = fullName, Value = reader["ci"] });
                }

                comboBoxCi.DisplayMember = "Text";
                comboBoxCi.ValueMember = "Value";
            }
        }
        private void Form4_Load(object sender, EventArgs e)
        {

        }

        private void button1_Click(object sender, EventArgs e)
        {
            string zona = textBoxZona.Text;
            string xini = textBoxXini.Text;
            string yini = textBoxYini.Text;
            string xfin = textBoxXfin.Text;
            string yfin = textBoxYfin.Text;
            decimal superficie = decimal.Parse(textBoxSuperficie.Text);
            string codigoCatastral = textBoxCod.Text;
            string ci = ((dynamic)comboBoxCi.SelectedItem).Value.ToString();
            string distrito = textBoxDistrito.Text;

            using (SqlConnection conn = new SqlConnection(connectionString))
            {
                string sql = "INSERT INTO Catastro (zona, xini, yini, xfin, yfin, superficie, codigo_catastral, ci, distrito) VALUES (@zona, @xini, @yini, @xfin, @yfin, @superficie, @codigo_catastral, @ci, @distrito)";
                SqlCommand cmd = new SqlCommand(sql, conn);
                cmd.Parameters.AddWithValue("@zona", zona);
                cmd.Parameters.AddWithValue("@xini", xini);
                cmd.Parameters.AddWithValue("@yini", yini);
                cmd.Parameters.AddWithValue("@xfin", xfin);
                cmd.Parameters.AddWithValue("@yfin", yfin);
                cmd.Parameters.AddWithValue("@superficie", superficie);
                cmd.Parameters.AddWithValue("@codigo_catastral", codigoCatastral);
                cmd.Parameters.AddWithValue("@ci", ci);
                cmd.Parameters.AddWithValue("@distrito", distrito);

                conn.Open();
                try
                {
                    cmd.ExecuteNonQuery();
                    MessageBox.Show("Propiedad registrada con éxito.");
                }
                catch (Exception ex)
                {
                    MessageBox.Show("Error: " + ex.Message);
                }
            }
        }

        private void button2_Click(object sender, EventArgs e)
        {
            Form2 f = new Form2();
            f.Show();
            this.Hide();
        }

        private void label10_Click(object sender, EventArgs e)
        {

        }
    }
}
