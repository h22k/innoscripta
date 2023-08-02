import Section from './components/base/Section'
import Navbar from './components/common/Navbar'
import Content from './components/sections/Content'
import Heading from './components/sections/Heading'

function App() {

    return (
        <Section className='mx-auto'>
            <Navbar/>
            <Heading/>
            <Content/>
        </Section>
    )
}

export default App
